<?php

namespace App\Http\Middleware;

use Closure;

class PermissionAdmin
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
        //nếu user da đăng nhập
        if($request->session ()->has ('userInfo')){
            $userInfo = $request->session ()->get ('userInfo');//lay session thông tin userInfo
            if($userInfo['level']=='admin')   return $next($request); // nếu là admin truy cập bthuong
            return redirect ()->route ('notify/noPermission');

        }

        return  redirect ()->route ('auth/login');


    }
}
