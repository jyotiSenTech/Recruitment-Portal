@extends('layouts.dahboard_layout')

@section('styles')
<style>
    .myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.9);
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }
</style>
@endsection

@section('body-page')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card container container-fluid">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                        <div class="row" style="margin-top: 15px;margin-bottom:15px;">
                            <h2>All Documents</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive">
                                    <tr>
                                        <th>Photo</th>
                                        <th>PAN</th>
                                        <th>Aadhar</th>
                                        <th>Domicile</th>
                                    </tr>
                                    <tr>
                                        <td><a class="myImg" target="_blank" href="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_Photo) }}"><img width="100" height="100" src="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_Photo) }}"></a></td>
                                        <td><a class="myImg" target="_blank" href="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_Sign) }}"><img width="100" height="100" src="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_Sign) }}"></a></td>
                                        <td><a class="myImg" target="_blank" href="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_Aadhar) }}">View Aadhar</a></td>
                                        <td><a class="myImg" target="_blank" href="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_Domicile) }}">View Domicile</a></td>
                                    </tr>
                                </table>
                                <table class="table table-responsive">
                                    <tr>
                                        <th>10th</th>
                                        <th>12th</th>
                                        <th>UG</th>
                                        <th>PG</th>
                                    </tr>
                                    <tr>
                                        <td><a class="myImg" target="_blank" href="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_SSC) }}">View 10th Marksheet</a></td>
                                        <td><a class="myImg" target="_blank" href="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_Inter) }}">View 12th Marksheet</a></td>
                                        <td><a class="myImg" target="_blank" href="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_UG) }}">View UG Marksheet</a></td>
                                        <td><a class="myImg" target="_blank" href="{{ url('assets/user/applicant/doc/' . $applicant_details->Applicant_ID . '/' . $applicant_details->Document_PG) }}">View PG Marksheet</a></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                                <span class="close">&times;</span>
                                <img class="modal-content" id="img01">
                                <div id="caption"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
@endsection

@section('scripts')
<script>
    var modal = document.getElementById("myModal");

    // Get all anchor elements with the class "myImg"
    var anchors = document.querySelectorAll(".myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    // Loop through each anchor element and add an event listener
    anchors.forEach(function(anchor) {
        anchor.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent the default behavior of the anchor
            modal.style.display = "block";
            modalImg.src = this.href; // Use the href attribute as the source
            captionText.innerHTML = this.textContent; // Use the link text as the caption
        });
    });

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>

@endsection