<!DOCTYPE html><html lang="ru">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
	<meta name="http-equiv=Cache-Control" content="content=no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="yandex-verification" content="bf64b65f48a8d53f" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if(Auth::check())
        <meta name="user-id" content="{{ Auth::user()->id }}">
    @endif
    <title>  @yield('title')</title>
    @yield('meta')
        @stack('css')
    <link href="{{asset('asset/front/css/style.css')}}" rel="stylesheet" type="text/css" />
	
    

        <!-- _________________________________________________________ -->
    <!--    -->
    <!-- _________________________________________________________ -->

    <script src="{{asset('asset/front/js/jquery/jquery-1.11.3.min.js')}}"></script>
    <script src="{{asset('asset/front/js/jquery/jquery-ui.min.js')}}"></script>

    <link rel="icon" href="{{asset('favicon.ico')}}">

    <!-- RedPush
    <script type="text/javascript" src="https://checkpost.me/?pu=gnstqnrwhe5ha3ddf4ytanjw" async></script> -->

    <!--poshmoose
    <script type='text/javascript' async defer src='https://pushmoose.com/static/script/myldl.js'></script>-->

</head>
<body class="page_register">
       <main class="col-xs-12">
           @include('layouts.frontend.nav')
           @include('layouts.frontend.mobile')
    @yield('content')
     @include('layouts.frontend.footer')
    
    </div>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122879313-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-122879313-2');
    </script>
    <script src="(js/bootstrap/bootstrap.min.js"></script>
    <script src="{{asset('asset/front/js/bootstrap/moment.js')}}"></script>
    <script src="{{asset('asset/front/js/bootstrap/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('asset/front/js/selectboxit.js')}}"></script>
    <script src="{{asset('asset/front/js/owl/owl.carousel.min.js')}}"></script>
    <script src="{{asset('asset/front/js/main.js')}}"></script>
     
		@stack('js')
 @if(auth()->check())
        <script>
            var authuser=@JSON(auth()->user())
        </script>
    @endif
</body>
</html>