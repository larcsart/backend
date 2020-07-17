<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next)
    {
        $token       = $request->header('token', null);
        // $tokenValid  = false;

        // to do - verify token
        // if ($token != null) {
        $tokenValid  = true;
        // }

        if (!$tokenValid) {
            // 401 Unauthorized – Client must be authorized before access, typically through some kind of login.
            return response()->json(['error' => 'Token invalid'], 401);
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
