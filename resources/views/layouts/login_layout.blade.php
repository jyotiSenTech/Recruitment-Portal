<!doctype html>
<html class=no-js lang=zxx>
<!DOCTYPE html>
<html lang="en-US" class="h-100">

<head>
  <meta charset=utf-8>
  <meta http-equiv=x-ua-compatible content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Women And Child Development Department</title>
  <meta name=viewport content="width=device-width,initial-scale=1,shrink-to-fit=no">

  <link rel="stylesheet" href="{{ url('login-page-assets/css/loginstyle.css') }}">
  <link rel=stylesheet href="{{url('/login-page-assets/css/app.min.css')}}">
  <link rel=stylesheet href="{{url('/login-page-assets/css/site.css')}}">
  <link rel=stylesheet href="{{url('/login-page-assets/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendor/boxicons/css/boxicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/lib/sweetalert2/sweetalert2.min.css') }}">

  @yield('styles')

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>

  @yield('main-content')
  <script src="{{url('assets/js/main.js')}}"></script>
  <script src="{{url('assets/js/jquery-3.5.1.js')}}"></script>
  <script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{ url('assets/lib/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ url('assets/lib/select2/select2.min.js') }}"></script>
  <script>
    // --- Hide alert message after 2 seconds --- //
    $("div.alert").fadeTo(2000, 500).slideUp(500, function() {
      $("div.alert").slideUp(500);
    });
    // --- Hide alert message after 2 seconds --- //
  </script>
  @yield('scripts')
</body>

</html>