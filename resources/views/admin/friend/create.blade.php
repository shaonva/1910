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
<center><h2>友情链接管理添加</h2><hr /></center>

<form action="{{url('/friend/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
 	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="w_name" id="lastname" 
				   placeholder="请输入网站名称">
		    <b style="color:red">{{$errors->first('w_name')}}</b>	
  		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="w_url" id="lastname" 
				   placeholder="请输入网站网址">
		    <b style="color:red">{{$errors->first('w_url')}}</b>			   
  		</div>
	</div>
	 
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">链接类型</label>
		<div class="col-sm-10">
			<input type="radio" name="w_lei" value="LOGO链接">LOGO链接
			<input type="radio" name="w_lei" value="文字链接">文字链接
			<b style="color:red">{{$errors->first('w_lei')}}</b>	
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站logo</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="w_photo" id="lastname" 
				   placeholder="请输入网站logo">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站联系人</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="w_men" id="lastname" 
				   placeholder="请输入网站联系人">
			<b style="color:red">{{$errors->first('w_men')}}</b>		   
  		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站介绍</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="w_desc" id="lastname" 
				   placeholder="请输入网站介绍"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="w_xian" value="是">是
			<input type="radio" name="w_xian" value="否">否
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>