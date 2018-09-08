<table class="table table-bordered">
	<thead>
		<tr>
			<th width="80">Auction</th>
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
        {!! Form::open(['method' => 'DELETE', 'route'=>['backend.blog.destroy',$post->id]]) !!}
				<a href="{{route('backend.blog.edit', $post->id)}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
				<button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
        {!! Form::close() !!}
			</td>
			<td>{{$post->title}}</td>
			<td>{{$post->author->name}}</td>
			<td>{{$post->category->title}}</td>
			<td><abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr> &nbsp;&nbsp;{!! $post->publicationLabel() !!}</td>
		</tr>
		@endforeach
	</tbody>
</table> 