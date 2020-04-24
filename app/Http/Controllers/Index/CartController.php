<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
class CartController extends Controller
{
    //购物车列表
    public function cartlist(){
    	
    	$user_id = session('admins')->admin_id;
    	$cart = \DB::select("select * ,buy_number*goods_price as price from cart where user_id=?",[$user_id]);
    	//dd($cart);
    	$buy_number = array_column($cart,'buy_number');
    	//dump($buy_number);
    	$count = array_sum($buy_number);
    	
    	$cart_id = array_column($cart, 'cart_id');

    	$checkedbuynumber = array_combine($cart_id,$buy_number);
        //dd($checkedbuynumber);
        
        //总价格
        $totalprice = array_sum(array_column($cart, 'price'));
 		//dd($totalprice);

    	//return view('index.cartlist',['cart'=>$cart,'count'=>$count,'checkedbuynumber'=>$checkedbuynumber]);
    	
    	return view('index.cartlist',compact('cart','count','checkedbuynumber','totalprice'));
    }

    //提交订单
    public function pay(){
    	$cart = Cart::all();
        $user_id = session('admins')->admin_id;
    	$cart = \DB::select("select * ,buy_number*goods_price as price from cart where user_id=?",[$user_id]);
     	
    	$cart_id = array_column($cart, 'cart_id');
    	//总价格
        $totalprice = array_sum(array_column($cart, 'price'));
    	return view('index.pay',['cart'=>$cart,'totalprice'=>$totalprice]);
    }

    //支付页面
    public function pay_success(){
    	$user_id = session('admins')->admin_id;
    	$cart = \DB::select("select * ,buy_number*goods_price as price from cart where user_id=?",[$user_id]);
     	
    	$cart_id = array_column($cart, 'cart_id');
    	//总价格
        $totalprice = array_sum(array_column($cart, 'price'));
    	return view('index.pay_success',['totalprice'=>$totalprice]);
    }
}
