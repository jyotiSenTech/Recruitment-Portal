@extends('layouts.login_layout')

@section('styles')
@endsection

@section('main-content')

<body class="d-flex flex-column h-100">
    <main role="main">

        <body style="background-color: aliceblue;">
            <div class="site-login">
                <!-- <div class="row" style="background-color: white;padding:10px">
                    <div class="col-lg-12" style="text-align: center;">
                        <a class="navbar-brand" style="color: darkred;font-weight:bold;">
                            <img src="{{url('assets/img/dpo.png')}}" alt="" style="width: 45px;">
                            <img src="{{url('assets/img/logolong.png')}}" alt="" style="width: 320px;">
                        </a>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"><br><br>

                        <div class="card">
                            <div class="card-body login-card-body">
                                <img src="{{url('assets/img/logonew.png')}}" alt="" style="width: 320px;">
                                <h4 class="text-center login-title"><br>लॉग इन</h4><br>
                                <form id="loginForm" action="{{url('/admin/validate-user')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <div class="form-group has-feedback field-loginform-password required">
                                                <div class="input-group mb-3"><input type="text" id="username" class="form-control" name="username" placeholder="यूजर आईडी दर्ज करें" aria-required="true">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="bi bi-person"></i></span></div>
                                                    </div>
                                                    <div id="error" class="invalid-feedback">
                                                        This field is required<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 form-group">
                                            <div class="form-group has-feedback field-loginform-password required">
                                                <div class="input-group mb-3"><input type="password" id="password" class="form-control" name="password" placeholder="पासवर्ड दर्ज करें" aria-required="true">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="bi bi-lock"></i></span></div>
                                                    </div>
                                                    <div id="error" class="invalid-feedback">
                                                        This field is required<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 form-group">
                                            <div class="form-group has-feedback field-loginform-password required">
                                                <div class="input-group mb-3"><input type="text" id="captcha" class="form-control" pattern="\d{4}" name="captcha" placeholder="कैप्चा दर्ज करें" aria-required="true">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="bi bi-puzzle"></i></span></div>
                                                    </div>
                                                    <div id="error" class="invalid-feedback">
                                                        This field is required<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" style="display: flex; justify-content: space-evenly;">
                                            <p class="svg-img captcha"><span>{!! captcha_img() !!}</span></p>
                                            &nbsp;&nbsp;&nbsp;
                                            <button type="button" class="mb-2 ml-19 reload" style="height:43px;font-size:large; border:white; background-color:white; padding: 5px;" id="reload">
                                                <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="login-button" style="width:100%;">Login</button>
                                    </div>
                                </form>
                                <p class="mb-1" style="text-align: left;">
                                    <a href="{{url('/add-new-user')}}">New user sign up</a>
                                    <a href="{{url('/')}}" style="float: right;"><i class="bi bi-house-door"></i> होम पेज पर जाएँ</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4"></div>

                </div>
            </div>
        </body>

        <!-- <footer class="loginfooter">
            <div class="container">
                <p class="text-center" style="font-size:11px;color:white;">Copyright © 2024 Website Content Managed by Department of Women & Child Development C.G.</p>
            </div>
        </footer> -->
    </main>
</body>

@endsection
@section('scripts')

<script>
    $(document).ready(function() {

        //to add and remove class from input feild
        $('form input').keyup(function() {
            if (this.value) {
                var element = $(this);

                // Remove the is-invalid class from input elements
                element.removeClass('is-invalid');
                element.addClass('was-validated');
            } else {
                var element = $(this);
                var elementName = element.attr('name');

                if (elementName != "post" && elementName != "pehchan" && elementName != "samiti_name" && elementName != "panjiyan_no" && elementName != "total_member" && elementName != "house_no" && elementName != "demand" && elementName != "pond_name" && elementName != "khasra_no" && elementName != "rakba" && elementName != "amount")
                    if (element.length) {
                        // Remove the is-invalid class from input elements
                        element.removeClass('was-validated');
                        element.addClass('is-invalid');
                        $('.error').html("This field is required");
                    }
            }
        });

        $('#loginForm').submit(function(e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid');
            $('span.error').text('');
            let password = $('#password').val();
            // if (password) {
            //     var encryptionKey = '{{ Config::get("environment.STATIC_SALT") }}';
            //     console.log(encryptionKey);
            //     var securePsw = encryptionKey + password + encryptionKey;
            //     let shaObj = new jsSHA("SHA-512", "TEXT");
            //     shaObj.update(securePsw);
            //     let hash = shaObj.getHash("HEX");
            //     $('#password').val(hash)
            // }

            var url = $(this).attr('action'); // Get the form action URL
            var form = new FormData(this);
            $.ajax({
                url: url,
                type: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                context: this,
                success: function(response) {
                    if (response.status == 'success') {
                        let red_url = response.url;
                        location.href = '{{ url("/") }}' + red_url;
                    } else if (response.status == 'failed') {
                        $(".captcha span").html(response.captcha);
                        $('#captcha').val('');
                        $('#password').val('');
                        if (response.msg && $.isEmptyObject(response.errors) == true) {
                            Swal.fire("Sorry!", response.msg, "error");
                        } else {
                            $.each(response.errors, function(index, value) {
                                console.log("Processing error for field:", index);
                                $('#' + index).addClass('is-invalid');
                                $('#' + index).closest('.form-group').find('.error').html("This field is required");
                            });
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        });
    });
</script>
@endsection