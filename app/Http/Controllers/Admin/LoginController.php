<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use DB;
use Validator;
use Illuminate\Validation\Rule;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $login = DB::table('login')->get();
       return view('admin.login.index',['login'=>$login]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.login.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$post = request()->except(['_token']);
    	//第一种验证
    	$request->validate([
    		'user_name' => 'required|unique:login|max:18',
    		'user_tel' => 'required',
    	],[
    		'user_name.required' => '品牌名称不能为空',
    		'user_name.unique' => '品牌名称已存在',
    		'user_name.max' => '管理员名称最大长度是18位',
    		'user_tel.required' => '手机号码不能为空',
    	]);
        
        $ret = Login::insert($post);
        if($ret){
        	return redirect('/login');
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
        //根据id获取信息
        $login = Login::find($id);
        return view('admin.login.edit',['login'=>$login]);
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
     	   'user_name' => [
        	   'required',
        		Rule::unique('login')->ignore($id,'user_id'),
        		'max:18'
        	],
        	'user_name' => 'required|unique:login|max:18',
    		'user_tel' => 'required',
        ],[
            'user_name.required' => '品牌名称不能为空',
    		'user_name.unique' => '品牌名称已存在',
    		'user_name.max' => '管理员名称最大长度是18位',
    		'user_tel.required' => '手机号码不能为空',
        ]);

        if($validator->fails()){
        	return redirect('login/edit/'.$id)->withErrors($validator)->withInput();
        }

        $login = Login::find($id);
        $login->user_name = $post['user_name'];
        $login->user_tel = $post['user_tel'];
        $login->user_time = $post['user_time'];
        $ret = $login->save();
        //dd($ret);
        if($ret!==false){
        	return redirect('/login');
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

        $ret = Login::destroy($id);
         if($ret){
 			return redirect('/login');
         }
    }
}
