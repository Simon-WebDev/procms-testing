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
<div class="register-box">
  <div class="register-logo">
    <a href="/"><b><i class="fa fa-home"></i> {{$settings->site_name}}</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">회원가입</p>

    <form method="POST" action="{{ route('register') }}">
      {{csrf_field()}}
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
        <input name="name" type="text" class="form-control" placeholder="이름" value="{{ old('name') }}"  autofocus required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" name="email" class="form-control" placeholder="이메일" value="{{ old('email') }}" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" name="password" class="form-control" placeholder="비밀번호" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      {{-- <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password_confirmation"  placeholder="비밀번호 확인">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div> 
        register controller, confirm deleted
      --}}
      <div class="row">
        <div class="col-xs-12">
          <div class="checkbox icheck {{ $errors->has('site_agree') ? ' has-error' : '' }}">
            <label>
              <input type="checkbox" name="site_agree" value="1" required> <button type="button" class="btn btn-info btn-sm" id="btn-agree"><i class="fa fa-link"></i> 회원약관</button> 에 동의 합니다
            </label>
            @if ($errors->has('site_agree'))
                <span class="help-block">
                    <strong>{{ $errors->first('site_agree') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="col-xs-12">
          <div class="checkbox icheck {{ $errors->has('privacy_agree') ? ' has-error' : '' }}">
            <label>
              <input type="checkbox" name="privacy_agree" value="1" required> <button type="button" class="btn btn-success btn-sm" id="btn-privacy"><i class="fa fa-link"></i> 개인정보취급방침</button> 에 동의 합니다
            </label>
            @if ($errors->has('privacy_agree'))
                <span class="help-block">
                    <strong>{{ $errors->first('privacy_agree') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-6 col-xs-offset-3">
          <button type="submit" class="btn btn-primary btn-block btn-flat m-t-20 m-b-10">회원가입</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
     
      {{-- <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a> --}}
    </div>
    <div class="row">
      <div class="col-xs-12">
        <a href="{{route('login')}}" class="text-center btn btn-block bg-orange  btn-flat"><i class="fa fa-sign-in"></i> 로그인 페이지</a>
      </div>
      <div class="col-xs-12">
        <a href="/login/naver" class="btn btn-block  btn-success btn-flat m-t-10">네이버 아이디로로 로그인</a>
      </div>
    </div>
  </div>
  <!-- /.form-box -->
</div>


{{-- site agree modal --}}
<div class="modal fade modal-info" id="siteAgree" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">회원약관</h4>
      </div>
      <div class="modal-body">
        {!! $settings->site_agreement !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
{{--site privacy modal --}}
<div class="modal fade modal-success" id="privacyAgree" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">개인정보취급방침</h4>
      </div>
      <div class="modal-body">
        {!! $settings->site_privacy !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
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
  });

  $('#btn-agree').click(function() {
    $('#siteAgree').modal();
  });
  $('#btn-privacy').click(function() {
    $('#privacyAgree').modal();
  });

  $('#mainFooter').css('display','none');
  $('#footer-bar').css('display','none');

</script>
@endsection


