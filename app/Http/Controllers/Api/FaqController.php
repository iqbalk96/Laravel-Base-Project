<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $faqs = Faq::latest()->paginate($perPage);

        if ($faqs->isEmpty()) {
            return $this->error('No faq data found.', 404);
        }

        $faqs->getCollection()->transform(function ($faq) {
            return [
                'id' => $faq->id,
                'question' => $faq->question,
                'answer' => $faq->answer,
                'is_active' => (bool) $faq->is_active,
                'created_at' => $faq->created_at,
                'updated_at' => $faq->updated_at,
            ];
        });

        return $this->success($faqs);
    }
}
