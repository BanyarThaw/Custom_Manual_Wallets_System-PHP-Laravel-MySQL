<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Token');

        if($header !== 'e5e9fa1ba31ecd1ae84f75caaa474f3a663f05f4') {
            return response([
                'success' => false,
                'message' => 'Something went wrong.',
            ], 400);
        }

        return $next($request);
    }
}
