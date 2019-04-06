<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>카테고리명</th>
			<th width="100">블로그 수</th>
			<th width="160">관리</th>
		</tr>
	</thead>
	<tbody>
		@foreach($categories as $category)
		<tr>
			<td>{{$category->title}}</td>
			<td>{{$category->posts->count()}}</td>
			<td>
        {!! Form::open(['method' => 'DELETE', 'route'=>['backend.categories.destroy',$category->id]]) !!}
				<a href="{{route('backend.categories.edit', $category->id)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>수정</a>
				@if($category->id == config('cms.default_category_id'))
					<button type="submit" class="btn btn-sm btn-danger disabled" onclick="return false"><i class="fa fa-trash"></i> 삭제</button>
				@else
					<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('삭제하시겠습니까?')"><i class="fa fa-trash"></i> 삭제</button>
				@endif
        {!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table> 