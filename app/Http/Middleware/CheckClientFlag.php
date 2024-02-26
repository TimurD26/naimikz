<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth; // Make sure to import the JWTAuth facade

class CheckClientFlag
{
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::user();
        dd($user);
        // Check if the isClient flag is set to 1
        if ($user->isClient == 1) {
            return redirect('http://naimikz-project/temp.html');
        }

        // Check if the isClient flag is set to 0
        if ($user->isClient == 0) {
            return redirect('http://naimikz-project/specs.html');
        }

        // If neither 1 nor 0, return a 401 error
        return abort(401);
    }
}
