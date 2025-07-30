<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\About;

class AboutController extends Controller
{
    use ApiResponse;

    public function show()
    {
        $about = About::first();

        if (!$about) {
            return $this->error('About data not found.', 404);
        }

        return $this->success([
            'title' => $about->title,
            'content' => $about->content,
            'image' => asset('storage/' . $about->image),
        ]);
    }
}
