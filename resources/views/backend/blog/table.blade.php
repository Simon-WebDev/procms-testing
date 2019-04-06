<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>제목</th>
			<th width="80px">작성자</th>
			<th width="140px">카테고리</th>
			<th width="80px">날짜</th>
			<th width="80px">상태</th>
			<th width="150px">관리</th>
		</tr>
	</thead>
	<tbody>
		@php 
			$request = request();
		@endphp
		@foreach($posts as $post)
		<tr>
			<td>{{str_limit($post->title,40)}}</td>
			<td>{{$post->author->name}}</td>
			<td>{{$post->category->title}}</td>
			<td><abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr> &nbsp;&nbsp;</td>
			<td>{!! $post->publicationLabel() !!}</td>
			<td>
		        {!! Form::open(['method' => 'DELETE', 'route'=>['backend.blog.destroy',$post->id]]) !!}
		        	@if(check_user_permissions($request, 'Blog@edit', $post->id))
						<a href="{{route('backend.blog.edit', $post->id)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>수정</a>
					@else
						<a href="#" class="btn btn-sm btn-info disabled"><i class="fa fa-edit"></i>수정</a>
					@endif	

					@if(check_user_permissions($request, 'Blog@destroy',$post->id))	
						<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i>삭제</button>
					@else
						<button type="button" onclick="return false" class="btn btn-sm btn-danger disabled"><i class="fa fa-times"></i>삭제</button>	
					@endif	
		        {!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table> 