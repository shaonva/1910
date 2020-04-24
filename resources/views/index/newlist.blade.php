@extends('layouts.shop')
@section('title','新闻')
@section('content')
  <body>
  <form>
 	<input type="text" name="paper_name" value="{{$paper_name}}" placeholder="请输入新闻名称">
 	<input type="text" name="paper_men" value="{{$paper_men}}" placeholder="请输入新闻作者">
 	<button>搜索</button>
  </form>
     <div class="prolist" id="div_test">
      @foreach($paper as $v)	
      <dl>
       <dt><a href=""><img src="{{env('UPLOADS_URLL')}}{{$v->paper_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="">{{$v->paper_name}}</a></h3>
        <div><strong>{{$v->paper_men}}</strong> <span>{{$v->paper_zi}}</span></div>
        <div><span>{{$v->paper_email}}</span> <br> <em>{{$v->paper_desc}}</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach  
      
     </div><!--prolist/-->
     <script>
     	//Ajax分页
     	$("#div_test").on("click",".pagination a",function(){
     		var url = $(this).prop('href');
     		$.ajax({
     			url : url,
     			dataType : 'text',
     			type : 'get',
     			success:function(ret){
     				$("#div_test").html(ret);
     			}
     		});
     		  return false;
     	})
     </script> 
	  @include('index.public.foot');	     
      @endsection