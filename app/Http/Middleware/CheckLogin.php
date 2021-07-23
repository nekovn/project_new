<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        //nếu tồn tại session userInfo thì cho nó quay về trang home
        if($request->session ()->has ('userInfo'))  return  redirect ()->route ('home');

        return $next($request);
    }
}
