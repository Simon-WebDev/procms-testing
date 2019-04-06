@extends('layouts.main')

@section('content')

<div class="container">
	<div class="row">
		<div class="m-t-20"></div>
		<div class="col-md-8 col-md-offset-2 col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">
						프로필
					</h3>
					<a href="/" class="btn bg-navy btn-sm pull-right"><i class="fa fa-home"></i> Home</a>
				</div>
				<div class="alert alert-danger">
					회언가입시 user role부분 subscriber로 기본설정됨.
					
					backend/userscontroller update부분 참고해서 작성할 필요. delete도 
				</div>
				@include('includes.messages')
				@include('includes.errors')
				<div class="box-body">
					{!! Form::model($user,['method'=>'patch','action'=>['ProfilesController@update',$user->id]]) !!}
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					    {!! Form::label('name','이름') !!}
					    {!! Form::text('name', null, ['class' => 'form-control']) !!}

					    @if($errors->has('name'))
					        <span class="help-block">{{ $errors->first('name') }}</span>
					    @endif
					</div>
					{{-- <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
					    {!! Form::label('slug','슬러그') !!}
					    {!! Form::text('slug', null, ['class' => 'form-control']) !!}

					    @if($errors->has('slug'))
					        <span class="help-block">{{ $errors->first('slug') }}</span>
					    @endif
					</div> --}}
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					    {!! Form::label('email','이메일') !!}
					    {!! Form::text('email', null, ['class' => 'form-control']) !!}

					    @if($errors->has('email'))
					        <span class="help-block">{{ $errors->first('email') }}</span>
					    @endif
					</div>
					<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
					    {!! Form::label('password','비밀번호') !!}
					    {!! Form::password('password', ['class' => 'form-control']) !!}
					    @if($errors->has('password'))
					        <span class="help-block">{{ $errors->first('password') }}</span>
					    @endif
					</div>
					
					<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
					    {!! Form::label('password_confirmation','비밀번호 확인') !!}
					    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}

					    @if($errors->has('password_confirmation'))
					        <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
					    @endif
					</div>
					{{-- <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
					    {!! Form::label('role','지위') !!}
					    @if($user->exists && ($user->id == config('cms.default_user_id') || isset($hideRoleDropdown)))
					        {!! Form::hidden('role', $user->roles->first()->id) !!}
					        <p class="form-control-static">{{$user->roles->first()->display_name}}</p>
					        
					    @else    
					    {!! Form::select('role',App\Role::pluck('display_name','id'), $user->exists ? $user->roles->first()->id : null, ['class' => 'form-control','placeholder' =>'Choose the role']) !!}
					    @endif

					    @if($errors->has('role'))
					        <span class="help-block">{{ $errors->first('role') }}</span>
					    @endif
					</div> --}}
					
					<div class="form-group">
					    {!! Form::label('bio','약력') !!}
					    {!! Form::textarea('bio', null, ['class' => 'form-control','rows'=>6]) !!}

					    @if($errors->has('bio'))
					        <span class="help-block">{{ $errors->first('bio') }}</span>
					    @endif
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>수정</button>
						<a href="{{URL::previous()}}" class="btn bg-default btn-labeled m-l-10"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>이전</a>
						{{-- <a href="{{route('profile.destroy',$user->id)}}" class="btn btn-danger btn-labeled m-l-10" onclick="return confirm('탈퇴하시겠습니까?')"><span class="btn-label"><i class="fa fa-user-times"></i></span>회원탈퇴</a> --}}
						
					</div>
					{!! Form::close() !!}
					<div class="form-group">
						{!! Form::open(['method'=>'delete','action'=>['ProfilesController@destroy',$user->id],'style'=>'display:inline']) !!}
						     <button type="submit" class="btn btn-danger btn-labeled" onclick="return(confirm('정말 탈퇴하시겠습니까?'))"><span class="btn-label"><i class="fa fa-user-times"></i></span>회원탈퇴</button>
						{!! Form::close() !!} 
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

@endsection

@section('script')
<script>
	$('#mainFooter, #footer-bar').css('display','none');
</script>
@endsection