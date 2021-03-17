<?php

namespace App\Http\Middleware;

use Closure;

class ChangeLanguage
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
        app()->setlocale('en');
        if(isset($request->lang) && $request->lang =='ar')
            app()->setlocale('ar');
        return $next($request);
    }
}
