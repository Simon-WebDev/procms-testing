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
    <p class="login-box-msg">로그인</p>

    <form  method="POST" action="{{ route('login') }}" role="form">
        {{ csrf_field() }}
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback ">
        <input type="email" class="form-control" placeholder="이메일" name="email" value="{{ old('email') }}" required>
        <span class="fa fa-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block form-group-feedback" aria-hidden="true">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input type="password" class="form-control" placeholder="비밀번호" name="password" required>
        <span class="fa fa-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 기억하기
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">로그인</button>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-xs-12">
          <a href="/login/naver" class="btn btn-block btn-success btn-flat m-t-10">네이버 아이디로 로그인</a>
        </div>
      </div>
    </form>

   
    <div class="row">
      <div class="col-xs-12">
        <a class="btn btn-block bg-maroon m-t-10" href="{{ route('password.request') }}"><i class="fa fa-key"></i> 비밀번호찾기</a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <a class="btn btn-block bg-orange m-t-10" href="{{ route('register') }}"><i class="fa fa-users"></i> 회원가입</a>
      </div>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
@endsection


@section('script')
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
    $('#mainFooter').css('display','none');
    $('#footer-bar').css('display','none');
  });
</script>

@endsection
