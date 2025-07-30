<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomCors
{
    public function handle(Request $request, Closure $next): Response
    {
        $origin = $request->headers->get('Origin');
        $allowedOrigins = explode(',', env('ALLOWED_ORIGINS', ''));
        $allowedOrigins = array_map('trim', $allowedOrigins);

        $allowProdApiDebug = filter_var(env('ALLOW_PROD_API_DEBUG', false), FILTER_VALIDATE_BOOLEAN);
        $isProduction = app()->environment('production');

        // Jika bukan production, atau debug production diizinkan
        if (!$isProduction || $allowProdApiDebug) {
            $response = $next($request);
            $response->headers->set('Access-Control-Allow-Origin', $origin ?? '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            return $response;
        }

        // Jika production dan origin tidak diizinkan
        if (!$origin || !in_array($origin, $allowedOrigins)) {
            return response()->json(['message' => 'CORS not allowed for this origin.'], 403);
        }

        // Lolos semua validasi
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', $origin);
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    }
}
