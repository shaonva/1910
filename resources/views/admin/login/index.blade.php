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
<center><h2>品牌管理列表</h2><a style="float:center;" href="{{url('/login/create')}}" class="btn btn-success">品牌管理添加</a><hr /></center>
<table class="table table-striped">
 	<thead>
		<tr>
			<th>管理员id</th>
			<th>管理员名称</th>
			<th>管理员手机号</th>
			<th>管理员邮箱</th>
			<th>管理员密码</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($login as $v)
		<tr>
			<td>{{$v->user_id}}</td>
			<td>{{$v->user_name}}</td>
			<td>{{$v->user_tel}}</td>
			<td>{{$v->user_email}}</td>
			<td>{{$v->user_pwd}}</td>
			<td>{{$v->user_time}}</td>
			<td>	
				<a href="{{url('/login/edit/'.$v->user_id)}}" class="btn btn-primary">管理员管理编辑</a>
				<a href="{{url('/login/destroy/'.$v->user_id)}}" class="btn btn-danger">管理员管理删除</a>
			</td>
		</tr>
	@endforeach
	  
	</tbody>
</table>

</body>
</html>