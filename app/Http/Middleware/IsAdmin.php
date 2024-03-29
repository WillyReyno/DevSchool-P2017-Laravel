<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsAdmin
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
        if(Auth::check() && Auth::user()->isAdmin) {
            return $next($request);
        }

        return redirect()
            ->route('post.index')
            ->with('success', 'Vous n\'avez pas les droits pour accéder à cette page.');

    }
}
