<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Yetkili
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
        if(Auth::check() && Auth::user()->onay==1 && Auth::user()->yetki==1)
        {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->onay==1 && Auth::user()->yetki>=2 && Auth::user()->yetki<=3 )
        {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->onay==1 && Auth::user()->yetki==88){
            return $next($request);
        }
        elseif(Auth::check() && Auth::user()->onay==1 && Auth::user()->yetki==4)
        {

            return redirect('/hasta_plan_kayit/goruntule');
        }
    }
}
