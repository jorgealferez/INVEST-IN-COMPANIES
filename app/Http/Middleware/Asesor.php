<?php

namespace App\Http\Middleware;

use Closure;

class Asesor
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
        if($request->user()->hasAnyRole(['Asesor','Admin'])){
            return $next($request);
        }

        abort(401, 'Esta acción no está autorizada.');
    }
}
