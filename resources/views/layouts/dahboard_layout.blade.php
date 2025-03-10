<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Women And Child Development Department</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->

  <link rel="stylesheet" href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendor/boxicons/css/boxicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendor/quill/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendor/quill/quill.bubble.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendor/remixicon/remixicon.css') }}">
  <link rel="stylesheet" href="{{ url('assets/vendor/simple-datatables/style.css') }}">
  <link rel="stylesheet" href="{{ url('assets/lib/sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/lib/select2/select2.min.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('assets/css/bootstrap5.min.css') }}">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  @yield('styles')
</head>

<body class="d-flex flex-column min-vh-100">

  @if (Session::get('sess_role') === "Candidate")
  @include('navigation.candidate_navigation')
  @elseif (Session::get('sess_role') === "Admin")
  @include('navigation.admin_navigation')
  @else
  @include('navigation.dpo_navigation')
  @endif

  @yield('body-page')
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer mt-auto">
    
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <strong>Developed By:</strong>  Department of Women and Child Development &copy; 2024
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{url('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{url('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{url('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{url('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{url('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('assets/js/main.js')}}"></script>
  <script src="{{url('assets/js/jquery-3.5.1.js')}}"></script>
  <script src="{{url('assets/js/dataTables.min.js')}}"></script>
  <script src="{{url('assets/js/dataTables.bootstrap5.min.js')}}"></script>
  <script src="{{ url('assets/lib/sweetalert2/sweetalert2.min.js')}}"></script>
  <script src="{{ url('assets/lib/select2/select2.min.js') }}"></script>
  @yield('scripts')
</body>

</html>