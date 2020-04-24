<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cate;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = Cate::all();
        return view('admin.cate.index',['cate'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$cate = Cate::all();
    	//调用无限极分类
        $cate = createWu($cate);
        //dd($cate);
        return view('admin.cate.create',['cate'=>$cate]);
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');
        $ret = Cate::create($post);
        if($ret){
        	return redirect('/cate');
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
    	  $cateList = Cate::all();
          $cate = Cate::find($id);
          
          return view('admin.cate.edit',['cate'=>$cate,'cateList'=>$cateList]);
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
          
         //orm操作
        $cate = Cate::find($id);
        $cate->cate_name = $post['cate_name'];
        $cate->parent_id = $post['parent_id'];
        $ret = $cate->save();
        //dd($ret);
        if($ret!==false){
        	return redirect('/cate');
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
         //orm操作
         $ret = Cate::destroy($id);
         if($ret){
 			return redirect('/cate');
         }
    }
}
