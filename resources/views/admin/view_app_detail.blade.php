@extends('layouts.dahboard_layout')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('body-page')
<main id="main" class="main">
    <div class="row printable-div">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card container" id="printable-div">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                        <div class="row">
                            <a href="{{ url('/admin/view-docs/' . md5($applicant_details->Applicant_ID))}}">View Documents</a>
                        </div>
                        <hr>
                        <div class="row">
                            <input type="hidden" id="user_id" value="{{$applicant_details->ID}}">
                            <div class="col-md-12">
                                <table class="table table-responsive">
                                    <tr>
                                        <td>
                                            प्रति,<br>
                                            संचालनालय महिला एवं बाल विकास विभाग,
                                            <br>अटल नगर ,
                                            <br>रायपुर छ.ग.
                                        </td>
                                        <td align="right">
                                            <img src="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_Photo) }}" width="160" height="130"><br>
                                            <img src="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_Sign) }}" width="160" height="80">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <h3>Personal Details</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive">
                                    <tr>
                                        <td>1. आवेदित पद का नाम</td>
                                        <td>{{ $applicant_details->title}}</td>
                                    </tr>
                                    <tr>
                                        <td>2. आवेदक का पूरा नाम</td>
                                        <td>{{ $applicant_details->First_Name}}&nbsp;{{$applicant_details->Middle_Name}}&nbsp;{{$applicant_details->Last_Name}}</td>
                                    </tr>
                                    <tr>
                                        <td>3. वर्तमान पता</td>
                                        <td>{{ $applicant_details->Corr_Address}}</td>
                                    </tr>
                                    <tr>
                                        <td>4. स्थायी पता</td>
                                        <td>{{ $applicant_details->Perm_Address}}</td>
                                    </tr>
                                    <tr>
                                        <td>5. जन्मतिथि</td>
                                        <td>{{ $applicant_details->DOB}}</td>
                                    </tr>
                                    <tr>
                                        <td>6. मोबाइल नंबर</td>
                                        <td>{{ $applicant_details->Contact_Number}}</td>
                                    </tr>
                                    <tr>
                                        <td>7. ईमेल आईडी</td>
                                        <td>{{ $applicant_details->Email}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <h3>Educational Qualification</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive table-bordered">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Qualification</th>
                                        <th>Board/University Name</th>
                                        <th>Obtained Marks</th>
                                        <th>Total Marks</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Post Graduation</td>
                                        <td>{{ $applicant_details->PG_University}}</td>
                                        <td>{{ $applicant_details->PG_Obtained_Marks}}</td>
                                        <td>{{ $applicant_details->PG_Total_Marks}}</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Graduation</td>
                                        <td>{{ $applicant_details->Graduation_University}}</td>
                                        <td>{{ $applicant_details->Graduation_Obtained_Marks}}</td>
                                        <td>{{ $applicant_details->Graduation_Total_Marks}}</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>12th</td>
                                        <td>{{ $applicant_details->School_Board_Name_12th}}</td>
                                        <td>{{ $applicant_details->Marks_Obtained_12th}}</td>
                                        <td>{{ $applicant_details->Marks_Total_12th}}</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>10th</td>
                                        <td>{{ $applicant_details->School_Board_Name_10th}}</td>
                                        <td>{{ $applicant_details->Marks_Obtained_10th}}</td>
                                        <td>{{ $applicant_details->Marks_Total_10th}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <h3>Work Experience Details</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive table-bordered">
                                    <tr>
                                        <th>Organization Name</th>
                                        <th>Organization Type</th>
                                        <th>Designation</th>
                                        <th>Nature of Work</th>
                                    </tr>
                                    @php
                                    $Organization_Name = $applicant_details->Organization_Name;
                                    $Nature_Of_Work = $applicant_details->Nature_Of_Work;
                                    $Organization_Type = $applicant_details->Organization_Type;
                                    $Designation = $applicant_details->Designation;

                                    $Organization_Name_arr = explode('|', $Organization_Name);
                                    $Organization_Type_arr = explode('|', $Organization_Type);
                                    $Designation_arr = explode('|', $Designation);
                                    $Nature_Of_Work_arr = explode('|', $Nature_Of_Work);
                                    @endphp

                                    @foreach ($Organization_Name_arr as $index => $orgName)
                                    <tr>
                                        <td>{{ $orgName }}</td>
                                        <td>{{ $Organization_Type_arr[$index] }}</td>
                                        <td>{{ $Designation_arr[$index] }}</td>
                                        <td>{{ $Nature_Of_Work_arr[$index] }}</td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        @if (Session::get('sess_role') === "Candidate")
                        @if($applicant_details->is_final_submit == 1)
                        <button type="button" onclick="printApplication(<?php echo $applicant_details->ID; ?>)" class="btn btn-primary btn-sm">Print</button><br><br>
                        @else
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form id="myForm">
                                @csrf
                                <input type="hidden" name="RowID" id="RowID" value="{{ $applicant_details->ID }}">
                                <input type="checkbox" id="confirmationCheckbox" required>&nbsp;&nbsp;मै यह घोषणा करता/करती हूँ कि ऊपर दी गयी जानकारी सही है |
                                <hr>
                                <div class="form-group formField">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit and Print</button>
                                    <button type="button" id="ajaxButton" class="btn btn-success btn-sm">Edit</button><br><br>
                                    <br><br>
                                </div>
                            </form>
                        </div>
                        @endif

                        @else
                        @if ($applicant_details->Application_Status === "Submitted")
                        <div class="row" style="background: #aabbcc;border-radius: 20px;margin-left:auto;margin-right:auto;margin-bottom:50px;">
                            <div class="col-md-12">
                                <form name="myform" method="post">
                                    <div class="row form-group formField" style="margin-top: 15px">
                                        <div class="col-md-5 col-xs-12">
                                            <label for="gender">पात्र/अपात्र </label><label style="color:red">*</label>
                                            <label class="radio-inline" style="margin-left: 30px;">
                                                <input id="gender" type="radio" name="verify" value="Approve">Eligible
                                            </label>
                                            <label class="radio-inline" style="margin-left: 20px;">
                                                <input type="radio" id="gender" name="verify" value="Reject">Not Eligible
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <textarea class="form-control" name="reason" id="reason" placeholder="Enter Remark" style="margin-bottom: 10px"></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="button" value="SAVE" class="btn btn-lg btn-info approve-reject-btn" style="margin-bottom: 10px">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
@endsection

@section('scripts')
<script>
    // Function to handle form submission
    function submitForm(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Check if the checkbox is checked
        if (document.getElementById("confirmationCheckbox").checked) {
            // Call your function here
            updateDataAndPrint();
        } else {
            // If the checkbox is not checked, alert the user or handle it as needed
            alert("Please confirm that the information provided is correct.");
        }
    }



    // Function to update data and print
    function updateDataAndPrint() {
        var rowid = document.getElementById('RowID').value;

        // AJAX request to update data in the controller
        $.ajax({
            url: "{{ url('/candidate/final-submit') }}",
            method: 'POST',
            data: {
                RowID: rowid
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Data updated successfully
                alert('Data Submitted successfully');

                // Proceed to print the page
                var pageUrl = '/candidate/print-application/' + rowid;
                printExternalPage(pageUrl);
            },
            error: function(xhr, status, error) {
                // Error handling
                console.error('Error updating data:', error);
            }
        });
    }

    // Define the function that constructs the URL and calls printExternalPage
    function printApplication(rowid) {
        var pageUrl = '/candidate/print-application/' + rowid;
        printExternalPage(pageUrl);
    }

    // Function to print the external page
    function printExternalPage(pageUrl) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the request
        xhr.open('GET', pageUrl, true);

        // Set up a callback function to handle the response
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Create a new temporary container element
                var tempContainer = document.createElement('div');

                // Insert the fetched content into the container
                tempContainer.innerHTML = xhr.responseText;

                // Get the content to print
                var printContents = tempContainer.innerHTML;

                // Save the original content of the page
                var originalContents = document.body.innerHTML;

                // Replace the current content of the page with the fetched content
                document.body.innerHTML = printContents;

                // Print the fetched content
                window.print();

                // Restore the original content of the page after printing
                document.body.innerHTML = originalContents;
            } else {
                // Handle the error if the request fails
                console.error('Request failed with status: ' + xhr.status);
            }
        };

        // Send the request
        xhr.send();
    }



    $('.approve-reject-btn').click(function(e) {
        e.preventDefault();
        var user_id = document.getElementById('user_id').value;
        var selectedValue = $("input[name='verify']:checked").val();
        var remark = document.getElementById('reason').value;

        if (selectedValue != "Reject" && selectedValue != "Approve") {
            alert("Please Select Application Status");
        } else if (remark == "" && selectedValue == "Reject") {
            alert("Please Enter Remark for Rejection");
        } else {
            var button_status = selectedValue;
            var error, btntext, error_hi, title, btnColor;
            if (button_status == 'Approve') {
                error = 'success';
                btntext = 'Approve';
                error_hi = 'स्वीकृत';
                title = "क्या इस आवेदन को आप स्वीकृत करना चाहते हैं ?";
                btnColor = 'green';
            } else {
                error = 'error';
                btntext = 'Reject';
                error_hi = 'अस्वीकृत';
                title = "क्या इस आवेदन को आप अस्वीकृत करना चाहते हैं ?";
                btnColor = 'red';
            }

            showSwal();
        }

        function showSwal() {
            Swal.fire({
                icon: 'warning',
                title: title,
                // text: 'This action cannot be undone.',
                showCancelButton: true,
                confirmButtonColor: btnColor,
                confirmButtonText: btntext,
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
                // input: btntext === 'Reject' ? 'text' : undefined, // Add the input field only for "Reject" action
                // inputPlaceholder: 'रिमार्क भरना अनिवार्य है', // Placeholder text for the input field
            }).then((result) => {
                if (result.value) {
                    // User clicked "Yes"
                    var rejectionReason = result.value;

                    $.ajax({
                        type: "POST",
                        url: "{{url('/')}}/admin/approve-reject-application",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            user_id: user_id,
                            button_status: button_status,
                            remark: remark
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'सफ़लतापूर्वक ' + error_hi +
                                        ' कर दिया गया है |',
                                    allowOutsideClick: false
                                }).then(() => {
                                    window.location.href =
                                        '/admin/application-list';
                                });
                            } else if (response.status == 'failed') {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'आवेदन  ' + error_hi +
                                        ' नहीं किया गया है, पुनः कोशिश करें |',
                                    allowOutsideClick: false
                                }).then(() => {
                                    // Handle error case
                                });
                            }
                        }
                    });

                } else {
                    // User clicked "Cancel" or closed the dialog
                    // Handle cancellation
                    var rejectionReason = result.value;
                    if (btntext === 'Reject' && rejectionReason.trim() === '') {
                        Swal.fire({
                            icon: 'error',
                            text: 'रिमार्क भरना अनिवार्य है',
                            allowOutsideClick: false
                        }).then(() => {
                            // Handle error case
                            showSwal(); // Recursive call to display the Swal dialog again
                        });
                    }
                }
            });
        }
    });

    document.getElementById('ajaxButton').addEventListener('click', function() {
        // Make an AJAX request
        var rowid = document.getElementById('RowID').value; // Assuming there's an input field with this ID
        // $.ajax({
        //     url: '/candidate/user-register-awc/' + rowid, // URL to your controller method
        //     type: 'POST', // HTTP method
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     success: function(response) {
        // Handle the response, for example, display the returned view
        window.location.href = '/candidate/user-register-awc/' + rowid + '/update';

        //     },
        //     error: function(xhr, status, error) {
        //         // Handle errors
        //         console.error('Error:', error);
        //     }
        // });
    });


    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("myForm").addEventListener("submit", submitForm);
    });
</script>
@endsection