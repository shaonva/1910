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
    	//dd(encrypt('456789'));
    	//session(['adminuser'=>null]);
    	//request()->session()->save();
    	//判断用户是否登录
    	$adminuser = session('adminuser');
    	if(!$adminuser){
    		 
    		//从cookie里面获取用户信息，并存入session里
    		$cookie_adminuser = request()->cookie('adminuser');
    		 
    		if($cookie_adminuser){
    		   session(['adminuser'=>$cookie_adminuser]);
    		}else{
    	      return redirect('/admins');
    		}
    	}
        return $next($request);
    }
}
