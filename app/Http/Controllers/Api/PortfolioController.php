<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $portfolios = Portfolio::with('category')->latest()->paginate($perPage);

        if ($portfolios->isEmpty()) {
            return $this->error('No portfolio data found.', 404);
        }

        $portfolios->getCollection()->transform(function ($portfolio) {
            return [
                'id' => $portfolio->id,
                'title' => $portfolio->title,
                'slug' => $portfolio->slug,
                'description' => $portfolio->description,
                'thumbnail' => $portfolio->thumbnail
                    ? asset('storage/' . ltrim($portfolio->thumbnail, '/'))
                    : null,
                'category' => $portfolio->category
                    ? [
                        'name' => $portfolio->category->name,
                    ]
                    : null,
                'client' => $portfolio->client,
                'year' => $portfolio->year,
                'is_featured' => (bool) $portfolio->is_featured,
                'is_active' => (bool) $portfolio->is_active,
                'created_at' => $portfolio->created_at,
                'updated_at' => $portfolio->updated_at,
            ];
        });

        return $this->success($portfolios);
    }
}
