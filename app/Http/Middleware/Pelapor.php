<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ApiFormatter;

class Pelapor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== 'pelapor'){
            return ApiFormatter::createApi(403, 'Forbidden');
        } elseif (auth()->user()->role == 'pelapor' && auth()->user()->verified_at == null) {
            return ApiFormatter::createApi(403, 'Forbidden');
        }
        return $next($request);
    }
}
