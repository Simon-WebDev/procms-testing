<header class="main-header">
  <!-- Logo -->
  <a href="/" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    {{-- if menu smaller, logo image 50x50 --}}
    <span class="logo-mini"><img src="{{asset('images/admin_mini_logo.png')}}"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><i class="fa fa-home"></i><b> {{$settings->site_name}}</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown notifications-menu">
          @php
            $new_boards = [];
            $new_resers = [];

            foreach (Auth::user()->unreadNotifications as $unreadNotification) {
              if ($unreadNotification->type == "App\Notifications\NewWriteNotification") {
                 $new_boards[] = $unreadNotification;
              }
              else if ($unreadNotification->type == "App\Notifications\ReservationNotification") {
                 $new_resers[] = $unreadNotification;
              }
            }

          @endphp

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell-o"></i>
            @if(count($new_boards) > 0 || count($new_resers) > 0)
            <span class="label label-warning">
              @php
                $total_count = count($new_boards) + count($new_resers);
              @endphp
                {{$total_count}}
            </span>
            @else
            <span class="label label-default">0</span>
            @endif
          </a>

          <ul class="dropdown-menu">
            <li class="header"><i class="fa fa-comments text-red"></i> 게시판에 {{count($new_boards)}}개의 새 글이 있습니다</li>
            <li>
            <li class="header"><i class="fa fa-calendar text-aqua"></i> 예약에  {{count($new_resers)}}개의 새 예약이 있습니다</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="{{route('backend.home')}}">
                    <i class="fa fa-comments text-red"></i> {{count($new_boards)}}개의 게시판 새 글 
                  </a>
                </li>
                <li>
                  <a href="{{route('backend.reservation')}}">
                    <i class="fa fa-calendar text-aqua"></i> {{count($new_resers)}}개의 새 예약 
                  </a>
                </li>
              
              </ul>
            </li>
            
          </ul>
        </li>

        <li class="dropdown user user-menu">
          @php 
            $currentUser = Auth::user();
          @endphp
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{$currentUser->gravatar()}}" class="user-image" alt="{{$currentUser->name}}">
            <span class="hidden-xs">{{Auth::user()->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{$currentUser->gravatar()}}" class="img-circle" alt="{{$currentUser->name}}">

              <p>
                {{$currentUser->name}} - {{$currentUser->roles->first()->display_name}}
                <small>Member since {{$currentUser->created_at->format('Y-m-d')}} </small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{url('edit-account')}}" class="btn btn-default btn-flat"><i class="fa fa-address-book-o"></i> 프로필</a>
              </div>
              <div class="pull-right">
                {{-- <a href="#" class="btn btn-default btn-flat">Sign out</a> --}}
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> 로그아웃
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->