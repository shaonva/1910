<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admins;
use Illuminate\Support\Facades\Cookie;

class AdminsController extends Controller
{
    public function doAdmin(Request $request){
    	 $admins = $request->except('_token');
     	 $adminuser = Admins::where('admin_name',$admins['admin_name'])->first();

    	 if(decrypt($adminuser->pwd)!=$admins['pwd']){
    	 	 return redirect('/admins')->with('msg','用户名或密码出现错误！！'); 
    	 }

         //七天免登录
         if($admins['isrember']){
         	//存cookie
         	Cookie::queue('adminuser',$adminuser,24*60*7);
         }
    	 session(['adminuser'=>$adminuser]);
    	 return redirect('/paper/create');
    }
}
