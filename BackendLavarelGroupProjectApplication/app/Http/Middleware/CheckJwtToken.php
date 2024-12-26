<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckJwtToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $request->merge(['userId' => $decoded->sub]); // Inject userId into the request
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid or expired token', 'details' => $e->getMessage()], 401);
        }

        return $next($request);
    }
}
