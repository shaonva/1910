<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
 //    return view('welcome');
//});

//闭包路由
Route::get('/wtc', function () {
     return '这是闭包路由哈';
});

//走控制器方法的路由
//返回视图的两种方式
//Route::get('/index','IndexController@index');
//路由视图
Route::view('/index','index',['name'=>'高重阳11']);
//post方式请求
Route::get('/user/add','IndexController@index');
Route::post('/user/doadd','IndexController@doadd')->name('doadd');

//必填参数
/*Route::get('/goods/{id}', function ($id) {
     return $id;
});*/
//Route::get('/goods/{id}','IndexController@good');
//Route::get('/goods/{id}/{name}','IndexController@goods')->where(['name'=>'[a-zA-Z\x{4e00}-\x{9fa5}]{3,6}']);

//可选参数
/*Route::get('/show/{id?}',function ($id=0) {
	return $id;
});*/

Route::get('/show/{id?}','IndexController@show');

//混合参数
Route::get('/detail/{id}/{name?}','IndexController@detail');

Route::domain('admin.laravel.com')->group(function(){
//品牌管理
Route::prefix('/brand')->middleware('islogin')->group(function(){
	Route::get('create','Admin\BrandController@create');//列表展示
	Route::post('store','Admin\BrandController@store');//添加页面
	Route::any('/','Admin\BrandController@index');//执行添加
	Route::get('edit/{id}','Admin\BrandController@edit');//编辑页面
	Route::post('update/{id}','Admin\BrandController@update');//执行编辑
	Route::get('destroy/{id}','Admin\BrandController@destroy');//删除
});

//分类管理
Route::prefix('/cate')->middleware('islogin')->group(function(){
	Route::get('create','Admin\CateController@create');//列表展示
	Route::post('store','Admin\CateController@store');//添加页面
	Route::get('/','Admin\CateController@index');//执行添加
	Route::get('edit/{id}','Admin\CateController@edit');//编辑页面
	Route::post('update/{id}','Admin\CateController@update');//执行编辑
	Route::get('destroy/{id}','Admin\CateController@destroy');//删除
});

//商品管理
Route::prefix('/goods')->middleware('islogin')->group(function(){
	Route::get('create','Admin\GoodsController@create');//列表展示
	Route::post('store','Admin\GoodsController@store')->name('goodsstore');//添加页面
	Route::get('/','Admin\GoodsController@index');//执行添加
	Route::get('edit/{id}','Admin\GoodsController@edit');//编辑页面
	Route::post('update/{id}','Admin\GoodsController@update')->name('goodsupdate');//执行编辑
	Route::get('destroy/{id}','Admin\GoodsController@destroy');//删除
});

//管理员管理
Route::prefix('/login')->group(function(){
	Route::get('create','Admin\LoginController@create');//列表展示
	Route::post('store','Admin\LoginController@store');//添加页面
	Route::get('/','Admin\LoginController@index');//执行添加
	Route::get('edit/{id}','Admin\LoginController@edit');//编辑页面
	Route::post('update/{id}','Admin\LoginController@update');//执行编辑
	Route::get('destroy/{id}','Admin\LoginController@destroy');//删除
});
 

//友情链接管理
Route::prefix('/friend')->group(function(){
	Route::get('create','Admin\FriendController@create');//列表展示
	Route::post('store','Admin\FriendController@store');//添加页面
	Route::get('/','Admin\FriendController@index');//执行添加
	Route::get('edit/{id}','Admin\FriendController@edit');//编辑页面
	Route::post('update/{id}','Admin\FriendController@update');//执行编辑
	Route::get('destroy/{id}','Admin\FriendController@destroy');//删除
}); 

//文章管理
Route::prefix('/paper')->middleware('islogin')->group(function(){
	Route::get('create','Admin\PaperController@create');//列表展示
	Route::post('store','Admin\PaperController@store');//添加页面
	Route::get('/','Admin\PaperController@index');//执行添加
	Route::get('edit/{id}','Admin\PaperController@edit');//编辑页面
	Route::post('update/{id}','Admin\PaperController@update');//执行编辑
	Route::get('destroy/{id}','Admin\PaperController@destroy');//删除
});
Route::view('/admins','admin.admins');
Route::post('/doAdmin','Admin\AdminsController@doAdmin');

//cookie的应用
Route::get('/setcookie','IndexController@setcookie');
Route::get('/getcookie','IndexController@getcookie');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
});
Route::domain('www.laravel.com')->group(function(){
//前台	
Route::get('/','Index\IndexController@index')->name('shop.index');//首页
Route::get('/login','Index\LoginController@login');//登录页面
Route::get('/reg','Index\LoginController@reg');//注册页面
Route::get('/prolist/{id}','Index\GoodsController@prolist');//商品列表页面

Route::get('/proinfo/{id}','Index\GoodsController@proinfo')->name('shop.proinfo');//商品详情

//手机号发送验证码
Route::post('/sendSms','Index\LoginController@sendSms');
Route::get('/sendEmail','Index\LoginController@sendEmail');

Route::post('/doLogin','Index\LoginController@doLogin');
Route::get('/addcar','Index\GoodsController@addcar');//加入购物车
Route::get('/cartlist','Index\CartController@cartlist')->name('shop.cartlist');//购物车列表页面
Route::get('/pay','Index\CartController@pay');//提交订单页面
Route::get('/pay_success','Index\CartController@pay_success');//支付页面

Route::get('/newlist','Index\NewsController@newlist');//新闻页面
});
