<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class HasApiTokenInRequestParam
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('api_token')) {
            return $this->authorizationError("Please provide API token");
        }

        $apiToken = $request->get('api_token');
        $user = $request->route('user');

        if ($apiToken !== $user->api_token) {
            return $this->authorizationError("Invalid API token provided");
        }

        return $next($request);
    }
}
