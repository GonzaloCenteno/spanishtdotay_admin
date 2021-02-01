<?php

namespace App\Http\Middleware;

use Closure;

class acceso
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
        $handle = $next($request);

        if(method_exists($handle, 'header'))
        {
            $handle->header('Cache-Control' , 'no-store, no-cache, must-revalidate')
                   ->header('Pragma', 'no-cache')
                   ->header('Expires', '0');
        }

        return $handle;
    }
}
