<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class RequireSubscriber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Auth::guard('subscriber')->check()) {
            return redirect('/');
        }
        App::setLocale(Auth::guard('subscriber')->user()->locale);

        return $next($request);
    }
}
