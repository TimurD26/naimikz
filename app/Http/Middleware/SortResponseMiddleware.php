<?php

// app/Http/Middleware/SortResponseMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SortResponseMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user has the 'isClient' attribute
            if ($user->isClient) {
                // If isClient == 1, redirect to http://naimikz-project/api/order/get_all
                return redirect('http://naimikz-project/api/order/get_all');
            } else {
                // If isClient != 1, redirect to http://naimikz-project/api/spec/get_all
                return redirect('http://naimikz-project/api/spec/get_all');
            }
        }

        // Continue with the request if the user is not authenticated
        return $next($request);
    }
}

