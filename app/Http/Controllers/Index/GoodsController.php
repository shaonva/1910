<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
	//商品列表 
    public function prolist(){
    	$goods = Goods::all();
    	return view('index.prolist',['goods'=>$goods]);
    }

     //商品详情
     public function proinfo($id){
     	$goods = Cache::get('goods');
        //dump($goods);
        
     	//访问量
     	$visit= Redis::setnx('visit_'.$id,1)?1:Redis::incr('visit_'.$id);
      	//dd($visit);
    	if(!$goods){
         //echo "DB==";
    	  $goods = Goods::find($id);
    	  //Cache::put('goods',$goods,60);
         }
    	return view('index.proinfo',['goods'=>$goods,'visit'=>$visit]);
    }

    //加入购物车
    public function addcar(){
    	$goods_id = request()->goods_id;
    	$buy_number = request()->buy_number;
    	
    	$user = session('admins');
    	if(!$user){
    		ShowMsg('00001','未登录');
     	}
    	$goods = Goods::select('goods_id','goods_name','goods_img','goods_price','goods_num')->find($goods_id);
    	//dd($goods);
    	if($goods->goods_num<$buy_number){
    	    ShowMsg('00002','库存不足');
    	}

    	$where = [
    		'user_id' => $user->admin_id,
    		'goods_id' => $goods_id
    	];
    	$cart = Cart::where($where)->first();
    	if($cart){
    		$buy_number = $cart->buy_number+$buy_number;
    		if($goods->goods_num<$buy_number){
    			$buy_number = $goods->goods_num;
    		} 
    		$res = Cart::where('cart_id',$cart->cart_id)->update(['buy_number'=>$buy_number]);
    	}else{
    	   $data = [
    	   	 'user_id' => $user->admin_id,
    	   	 'buy_number' => $buy_number,
    	   	 'add_time' => time()
    	  ]; 

    	  $data = array_merge($data,$goods->toArray());
    	  unset($data['goods_num']);
    	  $res = Cart::create($data);
    	}
    	 if($res!==false){
    	 	ShowMsg('00000','成功喽');
    	 }
    }

    
}
