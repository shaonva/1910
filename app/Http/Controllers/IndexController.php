<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class IndexController extends Controller
{

	public function setcookie(){
		//第一种设置cookie的方法
	    //return response('设置cookie哦')->cookie('name','傲娇少女~',1);
		//第二种设置cookie的方法
		//Cookie::queue(Cookie::make('hobby','撩汉👅',1));
		//第三种设置cookie的方法
		Cookie::queue('num',520,1);
	}

	public function getcookie(){
		//第一种获取cookie的方法
		//echo request()->cookie('name');
		//第一种获取cookie的方法
		echo Cookie::get('num');
	}
    public function index(){
    	//echo '这是Index控制器里面的index方法';
    	return view('index',['name'=>'东京女']);
    }

    public function doadd(){
    	$post = request()->all();
    	dd($post);
    }

    public function goods($id,$name){
    	echo $id;
    	echo $name;
    }

    public function good($id){
    	echo '单个:'.$id;
     }

     public function show($id=0){
     	echo '可选：'.$id;
     } 

     public function detail($id,$name=null){
     	echo $id;
    	dd($name);
     }
}
