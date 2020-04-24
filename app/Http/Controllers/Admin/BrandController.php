<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$page = request()->page??1;
    	//搜索
    	$brand_name = request()->brand_name??'';

    	$brand = Cache::get('brand_'.$page.'_'.$brand_name);
    	dump($brand);
     if(!$brand){
     	dump('数据库哈');
    	$where = [];
    	if($brand_name){
    		$where[] = ['brand_name','like',"%$brand_name%"];
    	}

    	//orm操作
    	$pageSize = config('app.pageSize');
        $brand = Brand::orderBy('brand_id','desc')->where($where)->paginate($pageSize);

        Cache::put('brand_'.$page.'_'.$brand_name,$brand,60);
    }

        //判断是不是Ajax请求
        if(request()->ajax()){
        	return view('admin.brand.ajaxindex',['brand'=>$brand,'brand_name'=>$brand_name]);
        }
        return view('admin.brand.index',['brand'=>$brand,'brand_name'=>$brand_name]);
    } 

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加方法
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    //第二种表单验证
    public function store(StoreBrandPost $request)
    {

    	//第一种验证
    	/*$request->validate([
    		'brand_name' => 'required|unique:brand|max:20',
    		'brand_zhi' => 'required',
    	],[
    		'brand_name.required' => '品牌名称不能为空',
    		'brand_name.unique' => '品牌名称已存在',
    		'brand_name.max' => '品牌名称最大长度是20位',
    		'brand_zhi.required' => '品牌网址不能为空',
    	]);*/
    	//接收post传过来的值
    	//$post = request()->post();
    	
    	//排除接收×××
        $post = request()->except(['_token']);

        //第三种表单验证
        $validator = Validator::make($post,[
        	'brand_name' => 'required|unique:brand|max:20',
    		'brand_zhi' => 'required',
        ],[
        	'brand_name.required' => '品牌名称不能为空',
    		'brand_name.unique' => '品牌名称已存在',
    		'brand_name.max' => '品牌名称最大长度是20位',
    		'brand_zhi.required' => '品牌网址不能为空',
        ]);
        if($validator->fails()){
        	return redirect('brand/create')->withErrors($validator)->withTnput();
        }
        //只接收×××
        //$post = request()->only(['_token','brand_logo']);
        //$brand_name = request()->brand_name;
        //dump($post);die;
         
        //文件上传
        if($request->hasFile('brand_logo')){
        	$post['brand_logo'] = $this->upload('brand_logo');
         }
        //$ret = Db::table('brand')->insert($post);
        //dd($ret);
        
        //orm操作
        //$brand = new Brand;
        //$brand->brand_name = $post['brand_name'];
        //$brand->brand_zhi = $post['brand_zhi'];
        //if(isset($post['brand_logo'])){
        	//$brand->brand_logo = $post['brand_logo'];
        //}	
        //$brand->brand_logo = $post['brand_logo'];
        //$brand->brand_desc = $post['brand_desc'];
        //$ret = $brand->save();
        //dd($ret);
        
        //$ret = Brand::create($post);
        $ret = Brand::insert($post);
        if($ret){
        	return redirect('/brand');
        } 
    }

    //文件上传
    public function upload($filename){
    	if(request()->file($filename)->isValid()){
    		//接收文件上传
    		$file = request()->$filename;
    		//实现文件上传
    		$path = $file->store('uploads');
    		return $path;
    	}
    	exit('文件上传出现错误');
    } 

    /**
     * Display the specified resource.
     *预览详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑展示页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //$brand = DB::table('brand')->where('brand_id',$id)->first();
       $brand = Brand::find($id);
       return view('admin.brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *执行更新
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = request()->except('_token');

        //第三种表单验证
        $validator = Validator::make($post,[
        	   'brand_name' => [
        	   'required',
        		Rule::unique('brand')->ignore($id,'brand_id'),
        		'max:20'
        	],
        	'brand_zhi' => 'required',
        ],[
        	'brand_name.required' => '品牌名称不能为空',
    		'brand_name.unique' => '品牌名称已存在',
    		'brand_name.max' => '品牌名称最大长度是20位',
    		'brand_zhi.required' => '品牌网址不能为空',
        ]);

        if($validator->fails()){
        	return redirect('brand/edit/'.$id)->withErrors($validator)->withInput();
        }
         //文件上传
        if($request->hasFile('brand_logo')){
        	$post['brand_logo'] = $this->upload('brand_logo');
         }
        //$ret = DB::table('brand')->where('brand_id',$id)->update($post);
        //orm操作
        $brand = Brand::find($id);
        $brand->brand_name = $post['brand_name'];
        $brand->brand_zhi = $post['brand_zhi'];
        if(isset($post['brand_logo'])){
        	$brand->brand_logo = $post['brand_logo'];
        }	
        $brand->brand_desc = $post['brand_desc'];
        $ret = $brand->save();
        //dd($ret);
        if($ret!==false){
        	return redirect('/brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除方法
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	 //删除图片
    	 $brand_logo = DB::table('brand')->where('brand_id',$id)->value('brand_logo');

    	 if($brand_logo){
    	 	unlink(storage_path('app/'.$brand_logo));
    	 }
    	 //dd(storage_path('app/'.$brand_logo));
         //$ret = DB::table('brand')->where('brand_id',$id)->delete();
         //orm操作
         $ret = Brand::destroy($id);
         if($ret){
 			return redirect('/brand');
         }
    }
}
