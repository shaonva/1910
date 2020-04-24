<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categorys;
use App\Goods;
use DB;
use App\Http\Requests\StoreGoodsPost;
use Validator;
use Illuminate\Validation\Rule;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$cate_id = request()->cate_id;
    	$where = [];
    	if($cate_id){
    		$where[] = ['goods.cate_id',$cate_id];
    	}
    	$goods_name = request()->goods_name;
    	$where = [];
    	if($goods_name){
    		$where[] = ['goods_name','like',"%$goods_name%"];
    	} 

    	$goodsList = Categorys::all();
        $goods = DB::table('goods')->get();
       return view('admin.goods.index',['goods'=>$goods,'goodsList'=>$goodsList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goodsList = Categorys::all();
        return view('admin.goods.create',['goodsList'=>$goodsList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {
    	 
        //$post = $request->all();
        //dd($post);
        $post = request()->except('_token');
        //dump($post);
        //dd($request->hasFile('goods_img'));
        //文件上传
        if($request->hasFile('goods_img')){
        	$post['goods_img'] = upload('goods_img');
        }
        //多文件上传
        if(isset($post['goods_imgs'])){
        	$imgs = MoreUpload('goods_imgs');
        	$post['goods_imgs'] = implode('|',$imgs);
        }
       $ret = Goods::create($post);
       if($ret){
       	return redirect('/goods');
       }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$goodsList = Categorys::all();
        //根据id获取信息
        $goods = Goods::find($id);
        return view('admin.goods.edit',['goods'=>$goods,'goodsList'=>$goodsList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = request()->except('_token');

        $validator = Validator::make($post,[
        	   'goods_name' => [
        	   'required',
        		Rule::unique('goods')->ignore($id,'goods_id'),
        		'max:50'
        	],
     		'goods_hao' => 'required',
    		'goods_num' => 'required|numeric|regex:/^\d{1,8}$/',
    		'goods_price' => 'required|numeric',
        ],[
        	'goods_name.required' => '商品名称不能为空',
    		'goods_name.unique' => '商品名称已存在',
    		'goods_name.max' => '商品名称最大长度是50位',
    		'goods_hao.required' => '商品货号不能为空',
    		'goods_num.required' => '商品库存不能为空',
    		'goods_num.numeric' => '商品库存必须是数字',
    		'goods_num.regex' => '商品库存长度不能超过8位',
    		'goods_price.required' => '商品价格不能为空',
    		'goods_num.numeric' => '商品价格必须是数字',
        ]);

        if($validator->fails()){
        	return redirect('goods/edit/'.$id)->withErrors($validator)->withInput();
        }

          //文件上传
         if($request->hasFile('goods_img')){
        	$post['goods_img'] = $this->upload('goods_img');
         }

        $goods = Goods::find($id);
        $goods->goods_name = $post['goods_name'];
        $goods->goods_hao = $post['goods_hao'];
        if(isset($post['goods_img'])){
        	$goods->goods_img = $post['goods_img'];
        }
        $goods->goods_desc = $post['goods_desc'];
        $ret = $goods->save();
        //dd($ret);
        if($ret!==false){
        	return redirect('/goods');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	//删除图片
     	 $goods_img = DB::table('goods')->where('goods_id',$id)->value('goods_img');

    	 if($goods_img){
    	 	unlink(storage_path('app/'.$goods_img));
    	 }
        $ret = Goods::destroy($id);
         if($ret){
 			return redirect('/goods');
         }
    }
}
