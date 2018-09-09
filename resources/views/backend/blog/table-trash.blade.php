<table class="table table-bordered">
	<thead>
		<tr>
			<th width="80">Action</th>
			<th>Title</th>
			<th width="120">Author</th>
			<th width="150">Category</th>
			<th width="170">Date</th>
		</tr>
	</thead>
	<tbody>
		@foreach($posts as $post)
		<tr>
			<td>
        {!! Form::open(['style'=>'display:inline-block','method' => 'PUT', 'route'=>['backend.blog.restore',$post->id]]) !!}
				<button title="restore" type="submit" class="btn btn-xs btn-default"><i class="fa fa-refresh"></i></button>
		{!! Form::close() !!}		
		{!! Form::open(['style'=>'display:inline-block','method' => 'DELETE', 'route'=>['backend.blog.force-destroy',$post->id]]) !!}		
				<button title="delete Permanent" type="submit" class="btn btn-xs btn-danger" onclick="return confirm('영구적으로 삭제하시겠습니까?')"><i class="fa fa-times"></i></button>
        {!! Form::close() !!}
			</td>
			<td>{{$post->title}}</td>
			<td>{{$post->author->name}}</td>
			<td>{{$post->category->title}}</td>
			<td><abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr> &nbsp;</td>
		</tr>
		@endforeach
	</tbody>
</table> 