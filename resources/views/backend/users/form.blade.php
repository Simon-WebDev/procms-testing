<div class="col-xs-12">
  <div class="box">
    <div class="box-body ">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name','이름') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}

            @if($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
        {{-- <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
            {!! Form::label('slug') !!}
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
        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
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
        </div>
       
        <div class="form-group {{ $errors->has('bio') ? 'has-error' : '' }}">
            {!! Form::label('bio','약력') !!}
            {!! Form::textarea('bio', null, ['class' => 'form-control','rows'=>6]) !!}

            @if($errors->has('bio'))
                <span class="help-block">{{ $errors->first('bio') }}</span>
            @endif
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-primary btn-labeled"><span class="btn-label"><i class="fa fa-check"></i></span>{{$user->exists ? "수정" : "저장"}}</button>
      <a href="{{URL::previous()}}" class="btn btn-default btn-labeled m-l-10"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>취소</a>
    </div>
  </div>
  <!-- /.box -->
</div>
