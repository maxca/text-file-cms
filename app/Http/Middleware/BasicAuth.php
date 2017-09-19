<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuth
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
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
            $_SERVER['PHP_AUTH_USER'] != "bdayuserz" || $_SERVER['PHP_AUTH_PW'] != "!sk**3egg"
        ) {
            Header("WWW-Authenticate: Basic realm=\"Login fail\"");
            Header("HTTP/1.0 401 Unauthorized");
            exit;
        }
        return $next($request);
    }
}
