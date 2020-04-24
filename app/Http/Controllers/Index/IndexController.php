<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
	//首页
    public function index(){
    	//使用cache门面
    	//$slide = Cache::get('slide');
    	//Redis::del('slide');
    	//使用redis门面
    	//$slide = Redis::get('slide');
    	//dump($slide);
    	
    	//使用辅助函数
    	$slide = cache('slide');
    	//dump($slide);
    	if(!$slide){
    	   //echo "DB==";
    	   //首页幻灯片
    	   $slide = Goods::select('goods_id','goods_img')->where('is_slide',1)->take(3)->get();
    	   //cache
    	   //Cache::put('slide',$slide,60);
    	   
    	   //使用redis门面
    	   //$slide = serialize($slide);
     	   //Redis::setex('slide',60,$slide);
     	   //使用辅助函数
     	   cache(['slide'=>$slide],60);
    	}
    	 
		//$slide = unserialize($slide); 
    	//dd($slide);
    	$goodsList = Goods::all();
    	return view('index.index',['slide'=>$slide,'goodsList'=>$goodsList]); 
    }   
}
