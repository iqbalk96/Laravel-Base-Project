<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $heroes = Hero::latest()->paginate($perPage);

        if ($heroes->isEmpty()) {
            return $this->error('No hero data found.', 404);
        }

        $heroes->getCollection()->transform(function ($hero) {
            return [
                'id' => $hero->id,
                'title' => $hero->title,
                'subtitle' => $hero->subtitle,
                'image' => $hero->image
                    ? asset('storage/' . ltrim($hero->image, '/'))
                    : null,
                'button_text' => $hero->button_text,
                'link' => $hero->link,
                'created_at' => $hero->created_at,
                'updated_at' => $hero->updated_at,
            ];
        });

        return $this->success($heroes);
    }
}
