<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BearerTokenHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $value = $request->cookie('bearer_token');
        if (!isset($value) || $value == '') {
            return response()->json(['message' => 'Unauthenticated, middleware'], 401);
        }
        $request->headers->set('Authorization', 'Bearer ' . $value);
        // dd($request->headers->get('Authorization'));
        return $next($request);
    }
}
