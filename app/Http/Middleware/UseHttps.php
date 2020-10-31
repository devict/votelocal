<?php

namespace App\Http\Middleware;

use Closure;

class UseHttps
{
    public function handle($request, Closure $next)
    {
        if (! $request->secure() && env('APP_ENV') === 'production') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
