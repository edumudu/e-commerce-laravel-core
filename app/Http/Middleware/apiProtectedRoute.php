<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class apiProtectedRoute extends BaseMiddleware
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
        $user = JWTAuth::parseToken()->authenticate();
        $request->merge(['user' => $user]);
      } catch (Exception $e) {
        if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
          return response()->json(['status' => 'Token is Invalid!'], 401);
        elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
          return response()->json(['status' => 'Token expired!'], 401);
        else
          return response()->json(['status' => 'Authorization Token not found'], 401);
      }

      return $next($request);
    }
}
