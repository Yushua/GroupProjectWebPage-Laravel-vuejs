<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            // Attempt to parse and authenticate the token
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            // Log the error for debugging purposes
            Log::error('JWT authentication failed: ' . $e->getMessage());

            // Check for specific exceptions and return appropriate responses
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return new JsonResponse(['error' => 'Token is Invalid'], 401);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return new JsonResponse(['error' => 'Token is Expired'], 401);
            } else {
                return new JsonResponse(['error' => 'Authorization Token not found'], 401);
            }
        }

        // Allow the request to proceed
        return $next($request);
    }
}
