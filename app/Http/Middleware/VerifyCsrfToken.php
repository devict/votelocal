<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'sms/receive',
    ];

    public function handle($request, Closure $next)
    {
        if (env('APP_ENV') === 'testing') {
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
