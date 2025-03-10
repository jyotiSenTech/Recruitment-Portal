@extends('layouts.dahboard_layout')

@section('styles')
@endsection

@section('body-page')
<main id="main" class="main">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Applications</h4>
                </div>
                <div class="table-responsive container" style="margin-top: 20px; margin-bottom: 20px;">
                    <table id="datatable" class="table table-striped table-bordered cell-border">
                        <thead>
                            <tr>
                                <!--<th>ID</th> yeh application ka id hai-->
                                <th>S.no.</th><!--yeh ros ka id hai-->
                                <th>Full Name</th>
                                <th>Mobile Number</th>
                                <th>DOB</th>
                                <th>Actions</th>
                                <th>Application Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($application_lists as $index => $application_list)
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
</main><!-- End #main -->
@endsection

@section('scripts')
<script>
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