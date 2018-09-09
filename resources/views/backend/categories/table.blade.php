<table class="table table-bordered">
	<thead>
		<tr>
			<th width="80">Action</th>
			<th>Category Name</th>
			<th width="120">Post Count</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach($categories as $category)
		<tr>
			<td>
        {!! Form::open(['method' => 'DELETE', 'route'=>['backend.categories.destroy',$category->id]]) !!}
				<a href="{{route('backend.categories.edit', $category->id)}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
				@if($category->id == config('cms.default_category_id'))
					<button type="submit" class="btn btn-xs btn-danger disabled" onclick="return false"><i class="fa fa-times"></i></button>
				@else
					<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('삭제하시겠습니까?')"><i class="fa fa-times"></i></button>
				@endif
        {!! Form::close() !!}
			</td>
			<td>{{$category->title}}</td>
			<td>{{$category->posts->count()}}</td>
			{{-- <td><abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr> &nbsp;&nbsp;{!! $post->publicationLabel() !!}</td> --}}
		</tr>
		@endforeach
	</tbody>
</table> 