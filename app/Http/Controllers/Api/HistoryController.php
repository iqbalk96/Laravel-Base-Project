<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\History;

class HistoryController extends Controller
{
    use ApiResponse;

    public function show()
    {
        $history = History::first();

        if (!$history) {
            return $this->error('History data not found.', 404);
        }

        return $this->success([
            'title' => $history->title,
            'content' => $history->content,
            'image' => asset('storage/' . $history->image),
            'year' => $history->year,
        ]);
    }
}
