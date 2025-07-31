<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ]);

        $perPage = (int) $request->input('per_page', 10);

        $clients = Client::latest()->paginate($perPage);

        if ($clients->isEmpty()) {
            return $this->error('No client data found.', 404);
        }

        $clients->getCollection()->transform(function ($client) {
            return [
                'id' => $client->id,
                'name' => $client->name,
                'logo' => $client->logo
                    ? asset('storage/' . ltrim($client->logo, '/'))
                    : null,
                'url' => $client->url,
                'created_at' => $client->created_at,
                'updated_at' => $client->updated_at,
            ];
        });

        return $this->success($clients);
    }
}
