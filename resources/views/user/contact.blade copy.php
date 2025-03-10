@extends('layouts.main_layout')

@section('styles')

@endsection

@section('main-content')

@include('header')

<body>
  <!--=== option Switcher ===-->
  <div class="main-wrapper"><br><br><br>
    <section class="mainContent full-width clearfix conactSection">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-xs-12">
            <div class="media addressContent">
              <span class="media-left bg-color-1" href="#">
                <!-- <i class="fa fa-map-marker" aria-hidden="true"></i> -->
              </span>
              <div class="media-body">
                <h3 class="media-heading"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Office:</h3>
                <p>महिला एवं बाल विकास विभाग , 2nd Floor, Indrawati Bhawan, New Raipur, Raipur, CG.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-xs-12">
            <div class="media addressContent">
              <span class="media-left bg-color-2" href="#">
                <!-- <i class="fa fa-phone" aria-hidden="true"></i> -->
              </span>
              <div class="media-body">
                <h3 class="media-heading"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Phone:</h3>
                <p>+91 7415-30-3000</p>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-xs-12">
            <div class="media addressContent">

              <span class="media-left bg-color-3" href="#">
                <!-- <i class="fa fa-envelope-o" aria-hidden="true"></i> -->
              </span>
              <div class="media-body">
                <h3 class="media-heading"> <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Email:</h3>
                <p><a href="">help@cgwcd.nic.in</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="mapArea areaPadding">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.9027287441468!2d81.79468511445671!3d21.156268988790035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a28c695f3d7d5d1%3A0xe23796cb5bbee93f!2sIndravati+Bhawan!5e0!3m2!1sen!2sin!4v1547531166208" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
@include('footer')