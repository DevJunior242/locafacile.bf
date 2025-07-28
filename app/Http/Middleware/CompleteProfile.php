<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = auth()->user();
        if (
            is_null($user->firstname)
            || is_null($user->lastname)
            || is_null($user->role)
            || is_null($user->phone)


        ) {
            return redirect()->route("completeProfile");
        }


        return $next($request);
    }
}
