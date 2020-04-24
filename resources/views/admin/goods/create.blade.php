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
<center><h2>商品管理添加</h2><hr /></center>

<form action="{{url('/goods/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
 	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_name" id="lastname" 
				   placeholder="请输入商品名称">
		    <span style="color:red">{{$errors->first('goods_name')}}</span>	
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_hao" id="lastname" 
				   placeholder="请输入商品货号">
		    <span style="color:red">{{$errors->first('goods_hao')}}</span>
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-10">
			  <select class="form-control" name="cate_id">
			 	 <option value='0'>请选择商品分类</option>
			 	 @foreach($goodsList as $v)
			 	 <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
			     @endforeach
			 </select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_price" id="lastname" 
				   placeholder="请输入商品价格">
			<span style="color:red">{{$errors->first('goods_price')}}</span> 	   
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_num" id="lastname" 
				   placeholder="请输入商品库存">
		    <span style="color:red">{{$errors->first('goods_num')}}</span>		   
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_show" value="1">显示
			<input type="radio" name="is_show" value="2">不显示
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_new" value="1">是
			<input type="radio" name="is_new" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_best" value="1">是
			<input type="radio" name="is_best" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否首页幻灯片推荐</label>
		<div class="col-sm-10">
			<input type="radio" name="is_slide" value="1">是
			<input type="radio" name="is_slide" checked value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="goods_img" id="lastname" 
				   placeholder="请输入商品图片">
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
			<input type="file" multiple="multiple" class="form-control" name="goods_imgs[]" id="lastname" 
				   placeholder="请输入商品图册">
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="goods_desc" id="lastname" 
				   placeholder="请输入商品详情"></textarea>
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