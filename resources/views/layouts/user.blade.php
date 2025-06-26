<!DOCTYPE HTML>
<html>

<head>
    <title>{{ e($master_setting['settings']->title ?? 'Default Event Title') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/x-icon" href="{{asset('public/ezzmyevent_favicon.png')}}">
    <link href="{{asset('public/css/bootstrap.min.css')}}?v=@php echo time(); @endphp" rel="stylesheet" />
    <link href="{{asset('public/css/bootstrap-icons.css')}}?v=@php echo time(); @endphp" rel="stylesheet" />
    <link href="{{asset('public/css/reset.css')}}?v=@php echo time(); @endphp" rel="stylesheet" />
    <link href="{{asset('public/css/style.css')}}?v=@php echo time(); @endphp" rel="stylesheet" />
    <link href="{{asset('public/css/intlTelInput.min.css')}}?v=@php echo time(); @endphp" rel="stylesheet" />
    <link href="{{asset('public/css/countrySelect.min.css')}}?v=@php echo time(); @endphp" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <style type="text/css">
        .lds-hourglass {
          width: 100% !important;
          height: 100vh !important;
          display: flex;
          justify-content: center;
          align-items: center;
          position: fixed;
          top: 0 !important;
          bottom: 0;
          left: 0 !important;
          right: 0;
          z-index: 99999999;
          background: #ffffff96;
        }
        .lds-hourglass {
          top: 495px;
          left: 64px;
          width: 248px;
          height: 140px;
          opacity: 1;
        }
    </style>
</head>

<body>
    <div style="display: none;" class="lds-hourglass">
        <lottie-player src="https://live.ezzmyevent.in/eventbot/imprints2023/public/97739-loader.json" background="transparent" speed="1" style="width: 248px; height: 140px;" loop="" autoplay=""></lottie-player>
      </div>
    <main>
        @yield('content')
</main>
<!--   <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
    
    <script src="{{asset('public/js/jquery-3.4.1.min.js')}}?v=@php echo time(); @endphp"> </script>
    <script src="{{asset('public/js/popper.min.js')}}?v=@php echo time(); @endphp"> </script>
    <script src="{{asset('public/js/bootstrap.bundle.min.js')}}?v=@php echo time(); @endphp"> </script>
    <script src="{{asset('public/js/intlTelInput.min.js')}}?v=@php echo time(); @endphp"> </script>
    <script src="{{asset('public/js/countrySelect.min.js')}}?v=@php echo time(); @endphp"> </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
                 
        });
    </script>
    @yield('script')
</body>

</html>