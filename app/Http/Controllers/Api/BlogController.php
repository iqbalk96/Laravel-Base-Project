<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $blogs = Blog::with('category')->latest()->paginate($perPage);

        if ($blogs->isEmpty()) {
            return $this->error('No blog data found.', 404);
        }

        $blogs->getCollection()->transform(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'slug' => $blog->slug,
                'excerpt' => $blog->excerpt,
                'thumbnail' => $blog->thumbnail
                    ? asset('storage/' . ltrim($blog->thumbnail, '/'))
                    : null,
                'category' => $blog->category
                    ? [
                        'name' => $blog->category->name,
                    ]
                    : null,
                'is_published' => (bool) $blog->is_published,
                'published_at' => $blog->published_at,
                'created_at' => $blog->created_at,
            ];
        });

        return $this->success($blogs);
    }


    public function show($slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->first();

        if (!$blog) {
            return $this->error('Blog not found.', 404);
        }

        $blog->thumbnail = $blog->thumbnail
            ? asset('storage/' . ltrim($blog->thumbnail, '/'))
            : null;

        return $this->success([
            'id' => $blog->id,
            'title' => $blog->title,
            'slug' => $blog->slug,
            'excerpt' => $blog->excerpt,
            'content' => $blog->content,
            'thumbnail' => $blog->thumbnail,
            'category' => [
                'name' => $blog->category->name,
            ],
            'is_published' => (bool) $blog->is_published,
            'published_at' => $blog->published_at,
            'created_at' => $blog->created_at,
        ]);
    }
}
