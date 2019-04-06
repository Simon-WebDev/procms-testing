@extends('layouts.main')



@section('style')
<style type="text/css">
.toast-top-center {  
    top: 12px; 
    left: 50%; 
    margin-left: -150px; 
} 
@media all and (max-width: 240px) { 
    .toast-top-center { 
        margin-left: -54px; 
    } 
} 
@media all and (min-width: 241px) and (max-width: 320px) { 
    .toast-top-center { 
        margin-left: -64px; 
    } 
} 
@media all and (min-width: 321px) and (max-width: 480px) { 
    .toast-top-center { 
        margin-left: -96px; 
    } 
}
</style>
@endsection

@section('content')
<nav id="myNavmenu" class="navmenu navmenu-default navmenu-fixed-left offcanvas" role="navigation" style="">
  <a class="navmenu-brand" href="#">Brand</a>
  <ul class="nav navmenu-nav">
    <li class="active"><a href="#">Home</a></li>
    <li><a href="#">Link</a></li>
    <li><a href="#">Link</a></li>
  </ul>
</nav>

<div class="canvas">
<h2>JASNY MENU</h2>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
           
           
                <div class="navbar navbar-default">
                  <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#myNavmenu" data-canvas="#myNavmenuCanvas" data-placement="left">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>

        </div>
    </div>
</div>




@php
//php list function
// $info = array('coffee', 'brown', 'caffeine');
// var_dump($info);
// echo "<hr>";
// list($drink, $color, $power) = $info;
// var_dump($drink);var_dump($color);
// echo "<hr>";
// var_dump($info);

//echo "$drink is $color and $power makes it special.\n";

@endphp

<hr>
<hr>
{{Carbon\Carbon::now()->modify('-1 year')}}

<hr>
{{str_random(16)}}

<hr>
@php
$board =App\Board::find(8);
$imagePath = public_path() . '/upload/' . $board->image1;
@endphp
{{$imagePath}}

@php
echo file_exists($imagePath) ? "yes" : "np";
@endphp

<hr>
<h4>Settings Variable Global</h4>
{{-- {{$settings->site_name}} <br>
{{$settings->site_phone}} <br>
{{$settings->site_email}} <br>
{{$settings->site_address}} <br>
{!! $settings->site_agreement !!} <br>
{!! $settings->site_privacy !!} <br> --}}
<hr>
{{config('cms.image.directory')}}
<hr>
@php 
$fileName="something.jpg";
$ext = substr(strrchr($fileName, '.'), 1);
$thumbnail = str_replace(".{$ext}","_thumb.{$ext}", $fileName);
$destination = config('cms.image.directory');
$page = App\Page::find(1);
use App\Http\Controllers\PagesController;
@endphp
{{$page->thumb_url}}
<hr>
{{$page->image_url}}


<hr>
@php 
Session::flash('success','dfdfs');

@endphp

<hr>

<h2>str_slug test</h2>
what:{{str_slug('연고')}}

<hr>


<hr>

</div>


<h1>Admin lte menu</h1>
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          
         
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>

              @if(Auth::user() && Auth::user()->unreadNotifications->count() > 0)
              <span class="label label-warning">{{Auth::user()->unreadNotifications->count()}}</span>
              @endif
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          
          
          
         
        </ul>
      </div>
    </nav>
  </header>


<h1>Notification Content</h1>
<ul>

@if(Auth::user() && Auth::user()->unreadNotifications->count() > 0)    
@foreach(Auth::user()->unreadNotifications as $unreadNotification)

<li><a href="{{route('backend.answer.create',$unreadNotification->data['board_id'])}}">{{$unreadNotification->data['new_board_title']."을" . $unreadNotification->data['user']['name']."님이 작성하셨읍니다"}}</a></li>





@endforeach
@else
<li>새 게시판글이 없습니다.</li>
@endif



</ul>

<hr>
@php
$results = [];
@endphp

@foreach(Auth::user()->unreadNotifications as $unreadNotification)
@php
if ($unreadNotification->type == "App\Notifications\NewWriteNotification") {
   $results[] = $unreadNotification;
}

@endphp
@endforeach


@foreach($results as $result)
{{$result->type}}

@endforeach


<h2>dfjdkfdk</h2>
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
@php
  $total_count = count($new_boards) + count($new_resers);
  
@endphp
  {{$total_count}}


@endsection


@section('script')
<script type="text/javascript">
	toastr.clear();
	toastr.success('dfkdkfdkfjkdjfkdfkdkfdkf');
	
	toastr.options.positionClass = 'toast-top-center'


   
</script>
@endsection


