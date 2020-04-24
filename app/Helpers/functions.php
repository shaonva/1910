<?php

//无限极分类
function createWu($data,$parent_id=0,$level=0){
    	if(!$data){
    		return;
    	}

    	static $newArray = [];
    	foreach($data as $v){
    		if($v->parent_id==$parent_id){
    			$v->level = $level;
    			$newArray[] = $v;

    			createWu($data,$v->cate_id,$level=1);
    		}
    	}
    	return $newArray;
    }

  
   //多文件上传
function MoreUpload($filename){
    	$file = request()->$filename;
    	if(!is_array($file)){
    		return;
    	}
    	foreach($file as $k => $v){
    		$path[$k] = $v->store('uploads');
    	} 
    	return $path;
    	exit('多文件上传出现错误');
    }

    //文件上传
function upload($filename){
    	if(request()->file($filename)->isValid()){
    		//接收文件上传
    		$file = request()->$filename;
    		//实现文件上传
    		$path  = $file->store('uploads');
    		return $path;
    	}
    	exit('文件上传出现错误');
    }

function ShowMsg($code,$msg){
   $data = [
   	  'code' => $code,
   	  'msg' => $msg
   ];
   echo json_encode($data);die;
}