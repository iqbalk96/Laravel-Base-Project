<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $categories = Category::latest()->paginate($perPage);

        if ($categories->isEmpty()) {
            return $this->error('No category data found.', 404);
        }

        $categories->getCollection()->transform(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'type' => $category->type,
                'is_active' => (bool) $category->is_active,
                'published_at' => $category->published_at,
                'created_at' => $category->created_at,
            ];
        });

        return $this->success($categories);
    }


    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return $this->error('Category not found.', 404);
        }

        return $this->success([
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'type' => $category->type,
            'is_active' => (bool) $category->is_active,
            'published_at' => $category->published_at,
            'created_at' => $category->created_at,
        ]);
    }
}
