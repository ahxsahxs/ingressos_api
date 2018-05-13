<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        $response = $next($request);
        if (!$request->isMethod('OPTIONS')) {
            return $response;
        }
        // $allow = $response->headers->get('Allow'); // true list of allowed methods
        // if (!$allow) {
        //     return $response;
        // }
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Max-Age' => 3600,
            'Access-Control-Allow-Headers' => 'Content-Type, Accept, Authorization, X-Requested-With, Application, Origin, X-Csrftoken',
        ];
        return $response->withHeaders($headers);        
    }
}
