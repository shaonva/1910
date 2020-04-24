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
 
<center><h2>文章管理列表</h2><a style="float:center;" href="{{url('/paper/create')}}" class="btn btn-success">文章管理添加</a><hr /></center>
 <form>	
 	<input type="text" name="paper_name" placeholder="请输入文章标题">
 	<input type="text" name="paper_men" placeholder="请输入文章作者">
 	<button>搜索</button>
 </form>
<table class="table table-striped">
 	<thead>
		<tr>
			<th>文章id</th>
			<th>文章标题</th>
 			<th>文章重要性</th>
			<th>是否显示</th>
			<th>文章作者</th>
			<th>作者Email</th>
			<th>关键字</th>
			<th>网页描述</th>
			<th>上传文件</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($paper as $v)
		<tr>
			<td>{{$v->paper_id}}</td>
			<td>{{$v->paper_name}}</td>
 			<td>{{$v->paper_yao}}</td>
			<td>{{$v->paper_xian ? '√':'×'}}</td>
			<td>{{$v->paper_men}}</td>
			<td>{{$v->paper_email}}</td>
			<td>{{$v->paper_zi}}</td>
			<td>{{$v->paper_desc}}</td>
			<td>@if($v->paper_img)<img src="{{env('UPLOADS_URLL')}}{{$v->paper_img}}" width="60px" height="50px">@endif</td>
 			<td>	
				<a href="{{url('/paper/edit/'.$v->paper_id)}}" class="btn btn-primary">文章管理编辑</a>
				<a href="{{url('/paper/destroy/'.$v->paper_id)}}" class="btn btn-danger">文章管理删除</a>
			</td>
		</tr>
	@endforeach
	  <tr>
	  	  <td colspan="7">{{$paper->links()}}</td>
	  </tr>
	</tbody>
</table>
 
</body>
</html>