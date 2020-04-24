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
<center><h2>商品管理列表</h2><a style="float:center;" href="{{url('/goods/create')}}" class="btn btn-success">商品管理添加</a><hr /></center>
<form>	
    <select>
 		<option value=''>--请选择分类--</option>
 		@foreach($goodsList as $v)
 		   <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
 		@endforeach
 		
 		<input type="text" name="goods_name" placeholder="请输入商品">
 		<button>搜索</button>  
    </select>
</form>
<table class="table table-striped">
 	<thead>
		<tr>
			<th>商品id</th>
			<th>商品名称</th>
			<th>商品货号</th>
			<th>商品分类</th>
			<th>商品价格</th>
			<th>商品库存</th>
			<th>是否显示</th>
			<th>是否新品</th>
			<th>是否精品</th>
			<th>商品图片</th>
			<th>商品相册</th>
			<th>商品详情</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($goods as $v)
		<tr>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_hao}}</td>
			<td>{{$v->cate_id}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_num}}</td>
			<td>{{$v->is_show}}</td>
			<td>{{$v->is_new}}</td>
			<td>{{$v->is_best}}</td>
			<td>@if($v->goods_img)<img src="{{env('UPLOADS_URLL')}}{{$v->goods_img}}" width="70px" height="70px">@endif</td>
			<td>	
 			@if(isset($v->goods_imgs))
 			@php $imgs = explode('|',$v->goods_imgs);@endphp
 			@foreach($imgs as $img)
 			<img src="{{env('UPLOADS_URLL')}}{{$img}}" width="70px" height="70px">
 			@endforeach
 			@endif
			</td>
			<td>{{$v->goods_desc}}</td>
			<td>	
				<a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-primary">商品管理编辑</a>
				<a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">商品管理删除</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</body>
</html>