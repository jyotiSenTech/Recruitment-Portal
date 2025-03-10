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
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title"><a href="/admin/application-list">Total <span>| Posts</span></a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$data['news_num']}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-3">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/admin/application-list">Total <span>| Applications</span></a></span></h5>
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
                    <div class="col-xxl-4 col-md-3">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/admin/verified-list">Verified <span>| Applications</span></a></span></h5>
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
                    <div class="col-xxl-4 col-md-3">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/admin/rejected-list">Rejected <span>| Applications</span></a></span></h5>
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
                    <h1>Recent Applications</h1>
                </div>
                <div class="card container">
                    <div class="table-responsive" style="margin-top: 20px; margin-bottom: 20px;">
                        <table id="datatable" class="table table-striped table-bordered cell-border">
                            <thead>
                                <tr>
                                    <!--<th>ID</th> yeh application ka id hai-->
                                    <th>ID</th><!--yeh ros ka id hai-->
                                    <th>Full Name</th>
                                    <th>Mobile Number</th>
                                    <th>DOB</th>
                                    <th>Actions</th>
                                    <th>Application Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['application_list'] as $index => $application_list)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $application_list->First_Name }}</td>
                                    <td>{{ $application_list->Contact_Number }}</td>
                                    <td>{{ $application_list->Last_Updated_dttime }}</td>
                                    <td>
                                        <a href="{{ url('/admin/view-application-detail/'.md5($application_list->Applicant_ID)) }}">
                                            <button class="btn btn-info btn-sm">View Application</button>
                                        </a>
                                    </td>
                                    <td>
                                        @if($application_list->Application_Status == 'Submitted')
                                        <strong style="color: gray">Submitted</strong>
                                        @elseif($application_list->Application_Status == 'Rejected')
                                        <strong style="color: red">Not Eligible</strong>
                                        @elseif($application_list->Application_Status == 'Verified')
                                        <strong style="color: green">Eligible</strong>
                                        @endif
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