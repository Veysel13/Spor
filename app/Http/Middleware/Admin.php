<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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

        //Auth::user()->yetki>0
        if(Auth::check() && Auth::user()->onay==1){
                return $next($request);
        }
        else{
        Auth::logout();
        return redirect('/')->withErrors(['message'=>'İlgili Yerlere ulaşmak için lütfen sisteme giriş yapınız']);
    }


    }
}
