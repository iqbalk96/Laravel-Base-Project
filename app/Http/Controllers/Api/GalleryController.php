<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $type = $request->input('type');

        if ($type && !in_array($type, ['photo', 'video'])) {
            return $this->error('Type must be photo or video.', 404);
        }

        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $query = Gallery::query()->latest();

        if ($type) {
            $query->where('type', $type);
        }

        $galleries = $query->paginate($perPage);

        if ($galleries->isEmpty()) {
            return $this->error('No gallery data found.', 404);
        }

        $galleries->getCollection()->transform(function ($gallery) {
            return [
                'id' => $gallery->id,
                'title' => $gallery->title,
                'type' => $gallery->type,
                'thumbnail' => $gallery->thumbnail
                    ? asset('storage/' . ltrim($gallery->thumbnail, '/'))
                    : null,
                'video_link' => $gallery->video_link,
                'created_at' => $gallery->created_at,
                'updated_at' => $gallery->updated_at,
            ];
        });

        return $this->success($galleries);
    }
}
