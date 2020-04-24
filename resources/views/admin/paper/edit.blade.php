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
<center><h2>文章管理编辑</h2><hr /></center>

<form action="{{url('/paper/update/'.$paper->paper_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
 	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$paper->paper_name}}" name="paper_name" id="lastname" 
				   placeholder="请输入文章标题">
		    <span style="color:red">{{$errors->first('paper_name')}}</span>		   
 		</div>
	</div>
	 
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio" name="paper_yao" value="普通">普通
			<input type="radio" name="paper_yao" value="置顶" checked>置顶
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="paper_xian" value="1" checked>显示
			<input type="radio" name="paper_xian" value="2">不显示
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$paper->paper_men}}" name="paper_men" id="lastname" 
				   placeholder="请输入文章作者">
		    <span style="color:red">{{$errors->first('paper_men')}}</span>		   
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$paper->paper_email}}" name="paper_email" id="lastname" 
				   placeholder="请输入作者email">
		    <span style="color:red">{{$errors->first('paper_email')}}</span>		   
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$paper->paper_zi}}" name="paper_zi" id="lastname" 
				   placeholder="请输入关键字">
		    <span style="color:red">{{$errors->first('paper_zi')}}</span>		   
 		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="paper_desc" id="lastname" 
				   placeholder="请输入网页描述">{{$paper->paper_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" name="paper_img" id="lastname" 
				   placeholder="请输入上传文件">
 		</div>
 		@if($paper->paper_img)<img src="{{env('UPLOADS_URLL')}}{{$paper->paper_img}}" width="60px">@endif
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>