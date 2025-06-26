<!DOCTYPE html>
<html>
<head>
  <title>ezzmyevent Admin Panel</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('public/ezzmyevent_favicon.png') }}">
  <link href="{{ asset('public/admin/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link href="{{ asset('public/admin/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/custom.css') }}" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
  
  @stack('style')
</head>
<body data-base-url="{{url('/')}}">
<div style="display: none;" class="lds-hourglass">
    <lottie-player src="https://live.ezzmyevent.in/eventbot/imprints2023/public/97739-loader.json" background="transparent" speed="1" style="width: 248px; height: 140px;" loop="" autoplay=""></lottie-player>
  </div>
  <div class="main-wrapper" id="app">

   
      @include('admin.elements.header')
    @include('admin.elements.sidebar')
      <div class="main-content">
        @yield('content')
      </div>
      @include('admin.elements.footer')
    
  </div>
    <script src="{{ asset('public/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js" type="text/javascript"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('public/admin/js/custom.js') }}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    @stack('custom-scripts')
</body>
</html>