<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Paper;
use Illuminate\Support\Facades\Cache;
class NewsController extends Controller
{
	 public function newlist(){
	 	$paper_name = request()->paper_name;
	 	$where = [];
	 	if($paper_name){
	 		$where[] = ['paper_name','like',"%$paper_name%"];
	 	}
	 	$paper_men = request()->paper_men;
	 	$where = [];
	 	if($paper_men){
	 		$where[] = ['paper_men','like',"%$paper_men%"];
	 	}
	 	$paper = Paper::all();
	 	return view('index.newlist',['paper'=>$paper,'paper_name'=>$paper_name,'paper_men'=>$paper_men]);
	 }
}
