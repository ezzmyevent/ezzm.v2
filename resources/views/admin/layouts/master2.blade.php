<!DOCTYPE html>
<html>
<head>
  <title>Ezzmyevent Admin Panel</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('public/ezzmyevent_favicon.png') }}">

  <!-- plugin css -->
 <!--  <link href="{{ asset('public/admin/assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" /> -->
  <!-- end plugin css -->


  <link href="{{ asset('public/admin/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link href="{{ asset('public/admin/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/custom.css') }}" rel="stylesheet" />

  @stack('plugin-styles')

  <!-- common css -->
  <!-- <link href="{{ asset('public/admin/css/app.css') }}" rel="stylesheet" /> -->
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}" class="login-page">

  <!-- <script src="{{ asset('public/admin/assets/js/spinner.js') }}"></script> -->

  <div class="main-wrapper" id="app">
    <div class="page-wrapper full-page">
      @yield('content')
    </div>
  </div>

    <!-- base js -->
    <script src="{{ asset('public/admin/js/app.js') }}"></script>
    <!-- <script src="{{ asset('public/admin/assets/plugins/feather-icons/feather.min.js') }}"></script> -->
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <!-- <script src="{{ asset('public/admin/assets/js/template.js') }}"></script> -->
    <!-- end common js -->

    @stack('custom-scripts')
</body>
</html>