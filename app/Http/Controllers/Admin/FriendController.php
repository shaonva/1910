<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Friend;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	 
    	//orm操作
    	$pageSize = config('app.pageSize');
        $friend = Friend::orderBy('w_id','desc')->paginate($pageSize);
 
        return view('admin.friend.index',['friend'=>$friend]);
    } 

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.friend.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加方法
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$request->validate([
    		'w_name' => 'required|unique:friend',
    		'w_url' => 'required',
    		'w_lei' => 'required',
    		'w_men' => 'required',
    	],[
    		'w_name.required' => '网站名称不能为空',
    		'w_name.unique' => '网站名称已存在',
    		'w_url.required' => '网站网址不能为空',
    		'w_lei.required' => '网站类型不能为空',
    		'w_men.required' => '网站联系人不能为空',
    	]);
        $post = request()->except('_token');
        //dd($request->hasFile('w_photo'));
        //文件上传
        if($request->hasFile('w_photo')){
        	$post['w_photo'] = $this->upload('w_photo');
         }
        $ret = DB::table('friend')->insert($post);
        if($ret){
        	return redirect('/friend');
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
        $friend = Friend::find($id);
       return view('admin.friend.edit',['friend'=>$friend]);
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

         //文件上传
        if($request->hasFile('w_photo')){
        	$post['w_photo'] = $this->upload('w_photo');
         }
         //orm操作
        $friend = Friend::find($id);
        $friend->w_name = $post['w_name'];
        $friend->w_men = $post['w_men'];
        if(isset($post['w_photo'])){
        	$friend->w_photo = $post['w_photo'];
        }	
        $friend->w_desc = $post['w_desc'];
        $ret = $friend->save();
        //dd($ret);
        if($ret!==false){
        	return redirect('/friend');
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
    	 $w_photo = DB::table('friend')->where('w_id',$id)->value('w_photo');

    	 if($w_photo){
    	 	unlink(storage_path('app/'.$w_photo));
    	 }
    	 //dd(storage_path('app/'.$brand_logo));
         //$ret = DB::table('brand')->where('brand_id',$id)->delete();
         //orm操作
         $ret = Friend::destroy($id);
         if($ret){
 			return redirect('/friend');
         }
    }
}
