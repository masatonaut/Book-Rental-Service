<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{

    private const READER_GUARD = "reader";
    private const LIBRARIAN_GUARD = "librarian";
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        if(Auth::guard(self::LIBRARIAN_GUARD)->check() && $request->routeis('librarian.*')){
            return redirect(RouteServiceProvider::LIBRARIAN_HOME);
        }
        if(Auth::guard(self::READER_GUARD)->check() && $request->routeis('reader.*')){
            return redirect(RouteServiceProvider::READER_HOME);
        }

        return $next($request);
    }
}
