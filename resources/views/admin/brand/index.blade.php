<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 条纹表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/brand')}}">商品品牌</a></li>
        <li><a href="{{url('/cate')}}">商品分类</a></li>
        <li><a href="{{url('/goods')}}">商品管理</a></li>
        <li><a href="{{url('/login')}}">管理员管理</a></li>
        <li><a href="{{url('/friend')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
<center><h2>品牌管理列表</h2><a style="float:center;" href="{{url('/brand/create')}}" class="btn btn-success">品牌管理添加</a><hr /></center>
<form>
 	<input type="text" name="brand_name" value="{{$brand_name}}" placeholder="请输入品牌名称">
 	<button>搜索</button>
</form>
<table class="table table-striped">
 	<thead>
		<tr>
			<th>品牌id</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌logo</th>
			<th>品牌描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($brand as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_zhi}}</td>
			<td>@if($v->brand_logo)<img src="{{env('UPLOADS_URLL')}}{{$v->brand_logo}}" width="60px">@endif</td>
			<td>{{$v->brand_desc}}</td>
			<td>	
				<a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-primary">品牌管理编辑</a>
				<a href="{{url('/brand/destroy/'.$v->brand_id)}}" class="btn btn-danger">品牌管理删除</a>
			</td>
		</tr>
	@endforeach
	  <tr>	
	  	 <td colspan="6">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td>
	  </tr>
	</tbody>
</table>
<script>	
	//无刷新分页
	$(document).on("click",".page-item a",function(){
		var url = $(this).attr('href');

		//第一种
		//$.get(url,function(result){
		//	$('tbody').html(result);
		//});
		//第二种
		$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
		$.post(url,function(result){
			$('tbody').html(result);
		});
		return false;
	})	
</script>
</body>
</html>