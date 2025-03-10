@extends('layouts.login_layout')

@section('styles')
@endsection

@section('main-content')

<body class="d-flex flex-column h-100">
    <main role="main">

        <body style="background-color: aliceblue;">
            <div class="site-login">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"><br><br>

                        <div class="card">
                            <div class="card-body login-card-body">
                                <img src="{{url('assets/img/logonew.png')}}" alt="" style="width: 320px;">
                                <h4 class="text-center login-title"><br>New User Sign-Up</h4><br>
                                <form id="myForm" action="{{url('/add-new-user')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group has-feedback field-loginform-password required">
                                                <label for="name">आवेदक का नाम/Applicant's Full Name</label><label style="color:red">*</label>
                                                <div class="input-group mb-3"><input type="text" id="name" class="form-control" name="name" placeholder="आवेदक का नाम दर्ज करें" aria-required="true">
                                                    <div id="error" class="invalid-feedback">
                                                        This field is required<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group has-feedback field-loginform-password required">
                                                <label for="mobile">मोबाइल नंबर/Mobile Number</label><label style="color:red">*</label>
                                                <div class="input-group mb-3"><input type="text" id="mob" class="form-control" name="mob" placeholder="मोबाइल नंबर दर्ज करें" aria-required="true" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                    <div id="error" class="invalid-feedback">
                                                        This field is required<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group has-feedback field-loginform-password required">
                                                <label for="dob">जन्मतिथि/Date of Birth </label><label style="color:red">*</label>
                                                <div class="input-group mb-3"> <input type="date" id="dob" class="form-control" name="dob">
                                                    <div id="error" class="invalid-feedback">
                                                        This field is required<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="login-button" style="width:100%;">Submit</button>
                                    </div>
                                </form>
                                <p class="mb-1" style="text-align: left;">
                                    <a href="{{url('/login')}}">Already Registered? Login</a>
                                    <a href="{{url('/')}}" style="float: right;"><i class="bi bi-house-door"></i> होम पेज पर जाएँ</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4"></div><br><br>

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

        $('form input[type="date"]').change(function() {
            var element = $(this);
            if (element.val()) {
                // Remove the is-invalid class and add the was-validated class
                element.removeClass('is-invalid');
                element.addClass('was-validated');
            } else {
                // Remove the was-validated class and add the is-invalid class
                element.removeClass('was-validated');
                element.addClass('is-invalid');
            }
        });

        $('#myForm').submit(function(e) {
            e.preventDefault(); // Prevent form from submitting normally

            var form = new FormData(this);
            var url = $(this).attr('action'); // Get the form action URL
            var csrf_token = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token value
            form.append('_token', '{{ csrf_token() }}');

            // Submit the form using AJAX
            $.ajax({
                url: url,
                type: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                context: this,
                success: function(data) {
                    // Handle the response from the server
                    console.log(data);
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: data['message'],
                            // text: 'आवेदन की स्थिति को ट्रैक करने के लिए इस आईडी का उपयोग करें',
                            allowOutsideClick: false
                        }).then((data) => {
                            window.location.href = '/login';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data['title'],
                            text: data['message'],
                            allowOutsideClick: false
                        })
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'warning',
                        title: 'कृपया सभी आवश्यक फ़ील्ड भरें ! <br> (Please Fill All Required Field) ',
                        text: 'Please see fields marked in red....',
                        allowOutsideClick: false
                    });

                    var response = JSON.parse(xhr.responseText);
                    if (response.errors) {
                        var errors = response.errors;
                        var errorMessages = '';

                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '<br>';
                            var element = $('[name="' + key + '"]');
                            if (element.length) {
                                element.addClass('is-invalid');
                            }
                        });
                        $('#error').html("This feild is required");
                    }
                }
            });
        });
    });
</script>
@endsection