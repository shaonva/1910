<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 条纹表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<center><h2>友情链接管理列表</h2><a style="float:center;" href="{{url('/friend/create')}}" class="btn btn-success">友情链接管理添加</a><hr /></center>
 
<table class="table table-striped">
 	<thead>
		<tr>
			<th>网站id</th>
			<th>网站名称</th>
			<th>网站网址</th>
			<th>链接类型</th>
			<th>图片LOGO</th>
			<th>网站联系人</th>
			<th>网站介绍</th>
			<th>是否显示</th>
 			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($friend as $v)
		<tr>
			<td>{{$v->w_id}}</td>
			<td>{{$v->w_name}}</td>
			<td>{{$v->w_url}}</td>
			<td>{{$v->w_lei}}</td>
			<td>@if($v->w_photo)<img src="{{env('UPLOADS_URLL')}}{{$v->w_photo}}" width="70px" height="70px">@endif</td>
			<td>{{$v->w_men}}</td>
			<td>{{$v->w_desc}}</td>
			<td>{{$v->w_xian}}</td>	
			<td>	
				<a href="{{url('/friend/edit/'.$v->w_id)}}" class="btn btn-primary">友情链接管理编辑</a>
				<a href="{{url('/friend/destroy/'.$v->w_id)}}" class="btn btn-danger">友情链接管理删除</a>
			</td>
		</tr>
	@endforeach
	 
	</tbody>
</table>

</body>
</html>