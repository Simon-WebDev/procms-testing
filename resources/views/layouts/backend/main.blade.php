<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', $settings->site_name)</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/css/AdminLTE.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('admin/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/simplemde/simplemde.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/bootstrapdatetimepicker/css/bootstrap-datetimepicker.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  @yield('style')
  <link rel="stylesheet" type="text/css" href="{{asset('admin/css/custom.css')}}">
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  @include('layouts.backend.navbar')
  @include('layouts.backend.sidebar')
 
  @yield('content')
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      &nbsp;
    </div>
    <strong>Copyright ©</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('admin/js/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/js/app.min.js')}}"></script>
<script src="{{asset('admin/plugins/simplemde/simplemde.min.js')}}"></script>

<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/moment/ko.js')}}"></script>


<script src="{{asset('admin/plugins/bootstrapdatetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('admin/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
<script src="{{asset('js/speakingurl.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('admin/js/Chart.min.js')}}"></script>
<script src="{{asset('admin/js/custom.js')}}"></script>
<script>
    {{-- in laravel 5.4 bootstrap pagination render is different. bootstrap3 style lender. fix pagination code --}}
    $(document).ready(function() {
        $('ul.pagination').addClass('justify-content-center');
        $('ul.pagination').children('li').addClass('page-item');
        $('ul.pagination li').children('a').addClass('page-link');
        $('ul.pagination li.active, ul.pagination li.disabled').children('span').addClass('page-link');

        $('ul.pagination').addClass('no-margin pagination-sm');

        //moment.js set locale (in blog, publishing time fixed)
        moment.locale('ko');
    });

    

  
</script>





@yield('script')
</body>
</html>
