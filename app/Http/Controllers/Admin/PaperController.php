<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Paper;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
    	//搜索
    	$paper_name = request()->paper_name;
    	$paper_men = request()->paper_men;
    	$where = [];
    	if($paper_name){
    		$where[] = ['paper_name','like',"%$paper_name%"];
    	}
    	if($paper_men){
    		$where[] = ['paper_men','like',"%$paper_men%"];
    	}
    	$paper_name = Cache::get('paper_name');
    	dump($paper_name);
    	if(!$paper_name){
    	   //echo "DB==";
    	   Cache::put('paper_name',$paper_name,60);
    	}
    	$paper_men = Cache::get('paper_men');
    	dump($paper_men);
    	if(!$paper_men){
    	   //echo "DB==";
    	   Cache::put('paper_men',$paper_men,60);
    	}     
        //$paper = DB::table('paper')->get();
        //分页
        $pageSize = config('app.pageSize');
        $paper = Paper::orderBy('paper_id','desc')->where($where)->paginate($pageSize);
		return view('admin.paper.index',['paper'=>$paper]);    	 
    } 

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paper.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加方法
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//验证
    	$request->validate([
    		'paper_name' => 'required|unique:paper',
      		'paper_men' => 'required',
    		'paper_email' => 'required',
    		'paper_zi' => 'required',
    	],[
    		'paper_name.required' => '文章标题不能为空',
    		'paper_name.unique' => '文章标题已存在',
      		'paper_men.required' => '文章作者不能为空',	
    		'paper_email.required' => '作者Email不能为空',	
    		'paper_zi.required' => '关键字不能为空',	
    	]);

		$post = request()->except('_token');
		//dd($post); 
		//上传文件
		if($request->hasFile('paper_img')){
			$post['paper_img'] = upload('paper_img');
		}
	    $ret = Paper::create($post);
        if($ret){
       	 return redirect('/paper');
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
         //根据id获取信息
        $paper = Paper::find($id);
       return view('admin.paper.edit',['paper'=>$paper]);
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
        if($request->hasFile('paper_img')){
        	$post['paper_img'] = $this->upload('paper_img');
         }
         //orm操作
        $paper = Paper::find($id);
        $paper->paper_name = $post['paper_name'];
        $paper->paper_men = $post['paper_men'];
        $paper->paper_zi = $post['paper_zi'];
        if(isset($post['paper_img'])){
        	$paper->paper_img = $post['paper_img'];
        }	
        $paper->paper_desc = $post['paper_desc'];
        $ret = $paper->save();
        //dd($ret);
        if($ret!==false){
        	return redirect('/paper');
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
    	 $paper_img = DB::table('paper')->where('paper_id',$id)->value('paper_img');

    	 if($paper_img){
    	 	unlink(storage_path('app/'.$paper_img));
    	 }
         //orm操作
         $ret = Paper::destroy($id);
         if($ret){
 			return redirect('/paper');
         }
    }
}
