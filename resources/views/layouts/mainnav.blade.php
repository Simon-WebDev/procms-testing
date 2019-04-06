<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#the-navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">MyBlog</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="the-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/"><i class="fa fa-home"></i> 홈</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">회사소개<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/about/map"><i class="fa fa-map"></i> 지도</a></li>
                    <li><a href="/about/about"><i class="fa fa-hospital-o"></i> 회사소개</a></li>
                    <li><a href="/about/doctors"><i class="fa fa-user-md"></i> 의사</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
        </li>
        <li><a href="{{route('blog')}}"><i class="fa fa-pencil"></i> Blog</a></li>
        <li><a href="{{route('board.index')}}"><i class="fa fa-comments"></i> 게시판</a></li>
        <li><a href="{{route('pages.index')}}"><i class="fa fa-microphone"></i> 공지사항</a></li>
        <li><a href="{{route('reservation.view')}}"><i class="fa fa-calendar"></i> 예약</a></li>
        <!-- Authentication Links -->
        @if (Auth::guest())
            {{-- <li><a href="{{ route('login') }}">Login</a></li> --}}
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">로그인<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" style="padding:10px; ">
                    <li class="user-header">
                        <form  method="POST" action="{{ route('login') }}" role="form">
                            {{ csrf_field() }}
                          <div class="input-group input-group-sm {{ $errors->has('email') ? ' has-error' : '' }} has-feedback ">
                            <input type="email" class="form-control" placeholder="이메일" name="email" value="{{ old('email') }}" required>
                            <span class="fa fa-envelope form-control-feedback"></span>
                            @if ($errors->has('email'))
                                <span class="help-block form-group-feedback" aria-hidden="true">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="input-group input-group-sm{{ $errors->has('password') ? ' has-error' : '' }} has-feedback m-t-5">
                            <input type="password" class="form-control" placeholder="비밀번호" name="password" required>
                            <span class="fa fa-lock form-control-feedback"></span>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                          </div>
                          
                            
                            <!-- /.col -->
                        <div class="form-group m-t-10">
                          <button type="submit" class="btn bg-navy btn-block btn-sm"><i class="fa fa-sign-in"></i> 로그인</button>
                        </div>

                        <div class="form-group m-t-5">
                          <a href="/login/naver" class="btn btn-block btn-default btn-sm">네이버 아이디로 로그인</a>
                          <a class="btn btn-block btn-default btn-sm" href="{{ route('password.request') }}"><i class="fa fa-key"></i> 비밀번호찾기</a>
                          <a class="btn btn-block btn-default btn-sm" href="{{ route('register') }}"><i class="fa fa-users"></i> 회원가입</a>

                        </div>
                        
                            <!-- /.col -->
                         
                         
                        </form>
                    </li>
                </ul>
            </li>
            <li><a href="{{ route('register') }}">회원가입</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    @role('subscriber')
                    <li><a href="{{route('profile.index',Auth::user()->slug)}}"><i class="fa fa-address-book-o"></i> 회원정보</a></li>
                    @endrole
                    @role(['admin','editor','author'])
                    <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    @endrole
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif
      </ul>
    </div>{{-- /.navbar-collapse --}}
  </div>{{-- /.container --}}
</nav>


