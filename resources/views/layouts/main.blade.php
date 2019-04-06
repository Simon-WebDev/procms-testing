<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="{{env('APP_NAME')}}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{URL::current()}}">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta property="og:image" content="">
    <link rel="canonical" href="{{route('blog')}}">
    <title>@yield('title', $settings->site_name)</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/simplemde/simplemde.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/bootstrapdatetimepicker/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/iCheck/square/blue.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="6930bd66-73d3-442f-a05f-57048af12fca";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
    </script>
    @yield('style')

</head>
<body>
    <header>
        @yield('mainnav')
    </header>
    <div id="app">
        @yield('content')
    
        
        <footer id="mainFooter">
            @yield('mainfooter')
        </footer>
        @include('layouts.footerbar')
    </div>

    
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
{{-- loginform, register form adminlte style --}}
    <script src="{{asset('admin/js/adminlte.min.js')}}"></script>
   
    <script src="{{asset('admin/plugins/simplemde/simplemde.min.js')}}"></script>

    <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/plugins/moment/ko.js')}}"></script>


    <script src="{{asset('admin/plugins/bootstrapdatetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('admin/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('js/speakingurl.min.js')}}"></script>
    <script src="{{asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('admin/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script>
        
        //for toast
          @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}")
          @endif
          @if(Session::has('info'))
            toastr.info("{{Session::get('info')}}")
          @endif
          @if(Session::has('warning'))
            toastr.warning("{{Session::get('warning')}}")
          @endif
          @if(Session::has('error'))
            toastr.error("{{Session::get('error')}}")
          @endif
             
         //end toastr 
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92866531-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-92866531-1');
    </script>

    @yield('script')
</body>
</html>
