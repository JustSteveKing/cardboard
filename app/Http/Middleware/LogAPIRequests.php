<?php

namespace App\Http\Middleware;

use App\Models\APIRequest;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogAPIRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        APIRequest::create([
            'path' => $request->getPathInfo(),
            'params' => json_encode($request->all()),
            'user_id' => $request->user()?->id,
        ]);

        return $next($request);
    }
}
