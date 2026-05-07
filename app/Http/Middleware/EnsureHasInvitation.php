<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureHasInvitation
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->session()->has('invitation')) {
            return redirect()->route('EnterCode');
        }

        return $next($request);
    }
}
