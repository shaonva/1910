<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
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
<center><h2>品牌管理编辑</h2><hr /></center>
<form action="{{url('/login/update/'.$login->user_id)}}" method="post" class="form-horizontal" role="form">
	@csrf
 	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$login->user_name}}" name="user_name" id="lastname" 
				   placeholder="请输入管理员名称">
		    <b style="color:red">{{$errors->first('user_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">手机号码</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$login->user_tel}}" name="user_tel" id="lastname" 
				   placeholder="请输入手机号码">
		    <b style="color:red">{{$errors->first('user_tel')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$login->user_email}}" name="user_email" id="lastname" 
				   placeholder="请输入管理员邮箱">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" value="{{$login->user_pwd}}" name="user_pwd" id="lastname" 
				   placeholder="请输入管理员密码">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">添加时间</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$login->user_time}}" name="user_time" id="lastname" 
				   placeholder="请输入添加时间">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>