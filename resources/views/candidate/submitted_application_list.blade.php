@extends('layouts.dahboard_layout')

@section('styles')
@endsection

@section('body-page')
<main id="main" class="main">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Submitted Applications</h4>
                </div>
                <div class="table-responsive container" style="margin-top: 20px; margin-bottom: 20px;">
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
                            @foreach ($application_lists as $index => $application_list)
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
                                    <a href="{{ url('/admin/view-application-detail/'.md5($application_list->Applicant_ID)) }}">
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