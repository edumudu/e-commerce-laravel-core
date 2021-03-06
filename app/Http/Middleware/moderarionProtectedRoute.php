<?php

namespace App\Http\Middleware;

use Closure;

class moderarionProtectedRoute
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
      $accept_access = ['admin', 'mod'];

      if(!auth('api')->check())
        return response()->json(['message' => 'User must be logged.'], 401);
      if(!in_array($request->user->role, $accept_access))
        return response()->json(['message' => 'User access level must be mod or higger.'], 403);

      return $next($request);
    }
}
