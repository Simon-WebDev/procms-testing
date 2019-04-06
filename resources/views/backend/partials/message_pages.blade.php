@if(session('message'))
  <div class="alert alert-info alert-dismissible" role="alert">
  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>{{session('message')}}</strong>
  </div>
@elseif(session('trash-message'))  
	
		@php 
			list($message,$pageId) = session('trash-message');
		@endphp
		
		{!! Form::open(['method'=>'PUT', 'route'=>['backend.page.restore',$pageId]]) !!}
		<div class="alert alert-info">
			{{$message}}
		&nbsp;<button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-undo"></i> 복원</button>
		</div>
		{!! Form::close() !!}
	
@endif
