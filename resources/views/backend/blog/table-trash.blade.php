<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>제목</th>
			<th width="80px">작성자</th>
			<th width="150px">카테고리</th>
			<th width="80px">날짜</th>
			<th width="180px">관리</th>
		</tr>
	</thead>
	<tbody>
		<?php $request = request() ?>
		@foreach($posts as $post)
		<tr>
			
			<td>{{str_limit($post->title,40)}}</td>
			<td>{{$post->author->name}}</td>
			<td>{{$post->category->title}}</td>
			<td><abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr> &nbsp;</td>
			<td>
		        {!! Form::open(['style'=>'display:inline-block','method' => 'PUT', 'route'=>['backend.blog.restore',$post->id]]) !!}
		        	@if(check_user_permissions($request, "Blog@restore", $post->id))
						<button title="복원" type="submit" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i> 복원</button>
					@else	
						<button title="restore" type="button" onclick="return false" class="btn btn-sm btn-default disabled"><i class="fa fa-refresh"></i> 복원</button>
					@endif	
				{!! Form::close() !!}		
				{!! Form::open(['style'=>'display:inline-block','method' => 'DELETE', 'route'=>['backend.blog.force-destroy',$post->id]]) !!}
					@if(check_user_permissions($request, "Blog@forceDestroy", $post->id))		
						<button title="영구삭제" type="submit" class="btn btn-sm btn-danger" onclick="return confirm('영구적으로 삭제하시겠습니까?')"><i class="fa fa-trash"></i> 영구삭제</button>
					@else
						<button title="영구삭제" type="button" onclick="return false" class="btn btn-sm btn-danger disabled" onclick="return confirm('영구적으로 삭제하시겠습니까?')"><i class="fa fa-trash"></i> 영구삭제</button>	
					@endif	
		        {!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table> 