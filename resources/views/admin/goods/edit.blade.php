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
<center><h2>商品管理编辑</h2><hr /></center>

<form action="{{url('/goods/update/'.$goods->goods_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
 	<div cl ass="form-group">  
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$goods->goods_name}}" name="goods_name" id="firstname" 
				   placeholder="请输入商品名称">
			<b style="color:red">{{$errors->first('goods_name')}}</b>	   
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$goods->goods_hao}}" name="goods_hao" id="lastname" 
				   placeholder="请输入商品货号">
			<b style="color:red">{{$errors->first('goods_hao')}}</b>	   
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
			<input type="text" class="form-control" value="{{$goods->goods_price}}" name="goods_price" id="lastname" 
				   placeholder="请输入商品价格">
			<b style="color:red">{{$errors->first('goods_price')}}</b> 		   
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$goods->goods_num}}" name="goods_num" id="lastname" 
				   placeholder="请输入商品库存">
			<b style="color:red">{{$errors->first('goods_num')}}</b>	   
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_show" value="1" checked>显示
			<input type="radio" name="is_show" value="2">不显示
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_new" value="1" checked>是
			<input type="radio" name="is_new" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_best" value="1" checked>是
			<input type="radio" name="is_best" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" name="goods_img" id="lastname" 
				   placeholder="请输入商品图片">  
 		</div>
 		@if($goods->goods_img)<img src="{{env('UPLOADS_URLL')}}{{$goods->goods_img}}" width="70px" height="70px">@endif	 
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="goods_desc" id="lastname" 
				   placeholder="请输入商品详情">{{$goods->goods_desc}}</textarea>
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