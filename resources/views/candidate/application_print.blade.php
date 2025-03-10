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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap5.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Vendor JS Files -->
    <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{url('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{url('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{url('assets/js/main.js')}}"></script>
    <script src="{{url('assets/js/jquery-3.5.1.js')}}"></script>
    <script src="{{url('assets/js/dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/dataTables.bootstrap5.min.js')}}"></script>
</body>

</html>

<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <input type="hidden" id="user_id" value="{{$applicant_details->ID}}">
                        <div class="col-md-12">
                            <h1 align="center">महिला एवं बाल विकास विभाग</h1>
                            <h2 align="center">PMMVY Recruitment-2019</h2>
                        </div>
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
                                    <td>आंगनबाड़ी कार्यकर्ता</td>
                                </tr>
                                <tr>
                                    <td>2. आवेदक का पूरा नाम</td>
                                    <td>{{ $applicant_details->Full_Name}}</td>
                                </tr>
                                <tr>
                                    <td>3. माता का नाम </td>
                                    <td>{{ $applicant_details->MotherName}}</td>
                                </tr>
                                <tr>
                                    <td>4. पिता/पति का नाम </td>
                                    <td>{{ $applicant_details->FatherName}}</td>
                                </tr>
                                <tr>
                                    <td>5. राष्ट्रीयता </td>
                                    <td>{{ $applicant_details->Nationality}}</td>
                                </tr>
                                <tr>
                                    <td>6. वर्ग </td>
                                    <td>{{ $applicant_details->Caste}}</td>
                                </tr>
                                <tr>
                                    <td>7. लिंग </td>
                                    <td>{{ $applicant_details->Gender}}</td>
                                </tr>
                                <tr>
                                    <td>8. क्या आप विकलांग है ? </td>
                                    <td>{{ $applicant_details->Is_Having_Disability}}</td>
                                </tr>
                                <tr>
                                    <td>9. क्या आप विवाहित है ? </td>
                                    <td>{{ $applicant_details->Marital_Status}}</td>
                                </tr>

                                <tr>
                                    <td>3. वर्तमान पता</td>
                                    <td>{{ $applicant_details->domicile}}</td>
                                </tr>
                                <tr>
                                    <td>4. स्थायी पता</td>
                                    <td>{{ $applicant_details->Perm_Address}}</td>
                                </tr>
                                <tr>
                                    <td>5. जन्मतिथि</td>
                                    <td>{{ $applicant_details->Date_Of_Birth}}</td>
                                </tr>
                                <tr>
                                    <td>6. मोबाइल नंबर</td>
                                    <td>{{ $applicant_details->Mobile_Number}}</td>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 align="center"><u><strong>संलग्न दस्तावेज</strong></u></h3>
                            <div class="col-sm-12">
                                <table class="table table-responsive">
                                    <tr>
                                        <td>1. 10th</td>
                                        <td>2. 12th</td>
                                    <tr>
                                    <tr>
                                        <td>3. UG</td>
                                        <td>4. PG</td>
                                    <tr>
                                    <tr>
                                        <td>5. मूल निवास प्रमाण पत्र</td>
                                        <td>6. जाति प्रमाण पत्र</td>
                                    <tr>
                                    <tr>
                                        <td>7. अनुभव प्रमाण पत्र</td>
                                        <td>8.</td>
                                    <tr>
                                    <tr>
                                        <td>9.</td>
                                        <td>10.</td>
                                    <tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h3 align="center"><u><strong>घोषणा पत्र</strong></u></h3>
                            मैं एतद् द्वारा घोषणा करता/करती हूँ कि इस प्रपत्र में दिए गए समस्त विवरण तथा संलग्न अभिलेख मेरी अधिकतम जानकारी और विश्वास के अनुसार सत्य है और यदि ये असत्य पाए जाते हैं , तो मेरी उम्मीदवारी / नियुक्ति निरस्त किये जाने योग्य होगी और मेरे विरुद्ध वैधानिक कार्यवाही की जा सकेगी |
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-">
                            <br>
                            <h4>स्थान:- </h4>
                            <h4>दिनांक:- </h4>
                        </div>
                        <div class="col-sm-6 text-right">
                            <br><br>
                            <h4>आवेदक के हस्ताक्षर एवं नाम </h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->