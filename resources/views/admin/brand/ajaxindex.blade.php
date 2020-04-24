@foreach($brand as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_zhi}}</td>
			<td>@if($v->brand_logo)<img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="60px">@endif</td>
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