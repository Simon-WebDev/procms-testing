@extends('layouts.main')

@section('style')
<style type="text/css">
  body {
    background-color: #d2d6de !important;
    background-image: none !important;
  }
</style>
@endsection

@section('content')

<div class="login-box">
  <div class="login-logo">
    <a href="/"><b><i class="fa fa-home"></i> {{$settings->site_name}}</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">비밀번호 재설정</p>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" name="email" class="form-control" placeholder="이메일" value="{{ old('email') }}" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-mail-forward"></i> 이메일 발송</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>

@endsection

@section('script')
<script>
  $(function () {
    $('#mainFooter').css('display','none');
    $('#footer-bar').css('display','none');
  });
</script>

@endsection
