<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $testimonials = Testimonial::latest()->paginate($perPage);

        if ($testimonials->isEmpty()) {
            return $this->error('No testimonial data found.', 404);
        }

        $testimonials->getCollection()->transform(function ($testimonial) {
            return [
                'id' => $testimonial->id,
                'name' => $testimonial->name,
                'position' => $testimonial->position,
                'message' => $testimonial->message,
                'photo' => $testimonial->photo
                    ? asset('storage/' . ltrim($testimonial->photo, '/'))
                    : null,
                'is_active' => (bool) $testimonial->is_active,
                'created_at' => $testimonial->created_at,
                'updated_at' => $testimonial->updated_at,
            ];
        });

        return $this->success($testimonials);
    }
}
