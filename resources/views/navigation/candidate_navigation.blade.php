<style>
  a {
    text-decoration-line: none;
  }
</style>


<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      {{-- <img src="{{url('assets/img/dpo.png')}}" alt="" style="width: 45px;"> --}}
      <img src="{{url('assets/img/logonew.png')}}" alt="" style="width: 220px;">
      {{-- <span class="d-none d-lg-block">PWD</span> --}}
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="{{url('assets/img/user_profile.jfif')}}" alt="Profile" class="rounded-circle" style="height: 25px;">
          <span class="d-none d-md-block dropdown-toggle ps-2">{{session()->get('sess_fname')}}</span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ url('/logout') }}">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{ url('/candidate/candidate-dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('/candidate/submitted-applications') }}">
        <i class="bi bi-file-earmark-text"></i>
        <span>All Applications</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('/candidate/user-register-awc/' . md5(3)) }}">
        <i class="bi bi-journal"></i>
        <span>Apply Now</span>
      </a>
    </li>
    <!--End Forms Nav -->
  </ul>

</aside><!-- End Sidebar-->