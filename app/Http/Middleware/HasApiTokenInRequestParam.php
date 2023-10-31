<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class HasApiTokenInRequestParam
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('api_token')) {
            return response()->json([
                'message' => "Please provide API token",
                'success' => false
            ], Response::HTTP_UNAUTHORIZED);
        }

        $apiToken = $request->get('api_token');
        $user = $request->route('user');

        if ($apiToken !== $user->api_token) {
            return response()->json([
                'message' => "Invalid API token provided",
                'success' => false
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
