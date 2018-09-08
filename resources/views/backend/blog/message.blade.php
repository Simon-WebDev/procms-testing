@if(session('message'))
  <div class="alert alert-info">
    <strong>{{session('message')}}</strong>
  </div>
@elseif(session('trash-message'))  
	
		@php 
			list($message,$postId) = session('trash-message');
		@endphp
		
		{!! Form::open(['method'=>'PUT', 'route'=>['backend.blog.restore',$postId]]) !!}
		<div class="alert alert-info">
			{{$message}}
		&nbsp;<button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-undo"></i> Undo</button>
		</div>
		{!! Form::close() !!}
	
@endif
