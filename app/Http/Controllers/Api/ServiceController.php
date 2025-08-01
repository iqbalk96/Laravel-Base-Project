<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $services = Service::latest()->paginate($perPage);

        if ($services->isEmpty()) {
            return $this->error('No service data found.', 404);
        }

        $services->getCollection()->transform(function ($service) {
            return [
                'id' => $service->id,
                'title' => $service->title,
                'slug' => $service->slug,
                'description' => $service->description,
                'image' => $service->image
                    ? asset('storage/' . ltrim($service->image, '/'))
                    : null,
                'is_active' => (bool) $service->is_active,
                'created_at' => $service->created_at,
                'updated_at' => $service->updated_at,
            ];
        });

        return $this->success($services);
    }
}
