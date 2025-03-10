@extends('layouts.dahboard_layout')

@section('styles')
@endsection

@section('body-page')
<main id="main" class="main">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h6>Click the type of recruitment you want to proceed</h6>
                </div>
                <div class="table-responsive container" style="margin-top: 20px; margin-bottom: 20px;">
                    <table id="datatable" class="table table-striped table-bordered cell-border">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Recruitment Type</th>
                                <th>Last Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schemes as $index => $scheme)
                            @if($scheme->Advertisement_ID == 3)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>Aanganbaadi Recruitment</td>
                                <td>21/06/2019</td>
                                <td>
                                    <a href="{{ url('/candidate/user-register-awc/' . md5($scheme->Advertisement_ID)) }}">
                                        <i class="bi bi-arrow-right"></i>&nbsp;Proceed
                                    </a>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{ $scheme->Advertisement_Title }}</td>
                                <td>21/06/2019</td>
                                <td>
                                    <a href="{{ url('/candidate/user-register/' . md5($scheme->Advertisement_ID)) }}">
                                        <i class="bi bi-arrow-right"></i>&nbsp;Proceed
                                    </a>
                                </td>
                            </tr>
                            @endif
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