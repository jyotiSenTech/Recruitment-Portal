<?php

use Illuminate\Support\Facades\DB;
?>
@extends('layouts.dahboard_layout')

@section('styles')
<style>
    a {
        font-size: medium;
    }
</style>
@endsection

@section('body-page')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/candidate/submitted-applications">Total <span>| Applications</span></a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$data['application_count']}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/candidate/submitted-applications">Total <span>| Submitted Applications</span></a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$data['verified_count']}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->


                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/candidate/submitted-applications">Total <span>| Scrutinized Applications</span></a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$data['rejected_count']}}</h6>
                                        <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customers Card -->
                </div>
            </div><!-- End Left side columns -->
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="pagetitle">
                    <h1>All Submitted Applications</h1>
                </div>
                <div class="card container">
                    <div class="table-responsive" style="margin-top: 20px; margin-bottom: 20px;">
                        <table id="datatable" class="table table-striped table-bordered cell-border">
                            <thead>
                                <tr>
                                    <th style="white-space: nowrap;">Application No.</th>
                                    <!-- <th style="white-space: nowrap;">Applicant ID</th> -->
                                    <th style="white-space: nowrap;">Name</th>
                                    <th style="white-space: nowrap;">Scheme Name</th>
                                    <th style="white-space: nowrap;">Postname</th>
                                    <th style="white-space: nowrap;">Remark</th>
                                    <th style="white-space: nowrap;">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['application_list'] as $index => $application_list)
                                <tr>
                                    <td>{{ $application_list->RowID }}</td>
                                    <!-- <td>{{ $application_list->Applicant_ID }}</td> -->
                                    <td>{{ $application_list->Full_Name }}</td>
                                    <td>
                                        <?php
                                        $postid = $application_list->Post_ID;
                                        $advData = DB::select("
                                        SELECT advertisement_master.Advertisement_Title AS advtitle
                                        FROM post_master
                                        INNER JOIN advertisement_master ON advertisement_master.Advertisement_ID = post_master.Advertisement_ID
                                        WHERE post_master.post_id = ?
                                    ", [$postid]);

                                        foreach ($advData as $advValue) {
                                            echo $advValue->advtitle;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        @if($application_list->Post_ID=='1')
                                        राज्य कार्यक्रम समन्वयक
                                        @elseif($application_list->Post_ID=='2')
                                        राज्य कार्यक्रम सहायक
                                        @elseif($application_list->Post_ID=='3')
                                        जिला कार्यक्रम समन्वयक
                                        @elseif($application_list->Post_ID=='4')
                                        जिला कार्यक्रम सहायक
                                        @elseif($application_list->Post_ID=='5')
                                        महिला कल्याण समन्वयक
                                        @elseif($application_list->Post_ID=='6')
                                        जिला समन्वयक सहायक
                                        @elseif($application_list->Post_ID=='7')
                                        आंगनबाड़ी कार्यकर्ता
                                        @elseif($application_list->Post_ID=='8')
                                        आंगनबाड़ी सहायिका
                                        @endif
                                    </td>
                                    <td>
                                        @if($application_list->Application_Status == 'Submitted')
                                        <strong style="color: gray">Submitted</strong>
                                        @elseif($application_list->Application_Status == 'Rejected')
                                        <strong style="color: green">Scrutinized</strong>
                                        @elseif($application_list->Application_Status == 'Verified')
                                        <strong style="color: green">Scrutinized</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/admin/view-application-detail/'.md5($application_list->RowID)) }}">
                                            <button class="btn btn-info btn-sm"><i class="bi bi-eye"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
@endsection

@section('scripts')
<script>
    var csrf_token = "{{ csrf_token() }}";

    $(document).ready(function() {

        $('#datatable').DataTable({
            "autoWidth": false,
            "paging": true,
            "lengthMenu": [10, 25, 50, 100],
            "dom": "<'row'<'col-sm-6'l><'col-sm-6'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>", // Customize the layout
            buttons: [
                'excel'
            ]
        });
    });
</script>
@endsection