<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\throwException;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                throwException(new JWTException('Token not valid'));
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'Unauthorized',
                'message' => $e->getMessage()
            ], 401);
        }

        // Proceed with the request if everything is okay
        return $next($request);
    }
}
