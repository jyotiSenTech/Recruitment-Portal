@extends('layouts.dahboard_layout')

@section('styles')
@endsection

@section('body-page')
<main id="main" class="main">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4>State Merit List</h4>
                </div>
                <div class="table-responsive container" style="margin-top: 20px; margin-bottom: 20px;">
                    <table id="datatable" class="table table-striped table-bordered cell-border">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Mobile Number</th>
                                <th>Educational Marks</th>
                                <th>Experience Marks</th>
                                <th>Govt. Experience Marks</th>
                                <th>Domicile Marks</th>
                                <th>Test Marks</th>
                                <th>Total Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($merit_lists as $index => $merit_list)
                            <tr>
                                <td>{{ $merit_list->Applicant_ID }}</td>
                                <td>{{ $merit_list->First_Name }}</td>
                                <td>{{ $merit_list->Contact_Number }}</td>
                                <td>{{ $merit_list->Edu_Qualification_Marks }}</td>
                                <td>{{ $merit_list->Experience_Marks }}</td>
                                <td>{{ $merit_list->Govt_Experience_Marks }}</td>
                                <td>{{ $merit_list->Domicile_Marks }}</td>
                                <td>{{ $merit_list->Test_Marks }}</td>
                                <td>{{ (int)$merit_list->Edu_Qualification_Marks + (int)$merit_list->Experience_Marks + (int)$merit_list->Govt_Experience_Marks + (int)$merit_list->Domicile_Marks + (int)$merit_list->Test_Marks }}</td>
                                <!-- <td>{{ $merit_list->Total_Marks }}</td> -->
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
