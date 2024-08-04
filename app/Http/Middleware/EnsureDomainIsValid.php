<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class EnsureDomainIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedDomains = explode(',', env('ALLOWED_DOMAINS', 'localhost'));

        $requestHost = parse_url($request->headers->get('origin'),  PHP_URL_HOST);

        Log::debug($requestHost);



        if (in_array($requestHost, $allowedDomains)) {
            return $next($request);
        }

        return abort(403, 'Access denied');
    }
}
