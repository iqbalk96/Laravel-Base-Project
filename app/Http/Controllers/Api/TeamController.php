<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $teams = Team::latest()->paginate($perPage);

        if ($teams->isEmpty()) {
            return $this->error('No team data found.', 404);
        }

        $teams->getCollection()->transform(function ($team) {
            return [
                'id' => $team->id,
                'name' => $team->name,
                'position' => $team->position,
                'bio' => $team->bio,
                'linkedin_url' => $team->linkedin_url,
                'photo' => $team->photo
                    ? asset('storage/' . ltrim($team->photo, '/'))
                    : null,
                'is_active' => (bool) $team->is_active,
                'created_at' => $team->created_at,
                'updated_at' => $team->updated_at,
            ];
        });

        return $this->success($teams);
    }
}
