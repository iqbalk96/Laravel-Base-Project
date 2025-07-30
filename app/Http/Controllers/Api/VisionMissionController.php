<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\VisionMission;

class VisionMissionController extends Controller
{
    use ApiResponse;

    public function show()
    {
        $visionMission = VisionMission::first();

        if (!$visionMission) {
            return $this->error('Vision mission data not found.', 404);
        }

        return $this->success([
            'vision' => $visionMission->vision,
            'mission' => $visionMission->mission,
            'image' => asset('storage/' . $visionMission->image),
        ]);
    }
}
