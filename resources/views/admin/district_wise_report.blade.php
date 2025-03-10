@extends('layouts.dahboard_layout')

@section('styles')
@endsection

@section('body-page')
<main id="main" class="main">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4>Application List</h4>
                </div>
                <div class="table-responsive container" style="margin-top: 20px; margin-bottom: 20px;">
                    <table id="datatable" class="table table-striped table-bordered cell-border">
                        <thead>
                            <tr>
                                <!--<th>ID</th> yeh application ka id hai-->
                                <th>S.no.</th><!--yeh ros ka id hai-->
                                <th>District</th>
                                <th>Submitted Applications</th>
                                <th>Approved Applications</th>
                                <th>Rejected Applications</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $index => $result)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $result->name }}</td>
                                <td>
                                    <a href="{{ url('/admin/application-list/'.$result->Pref_Districts) }}">
                                        {{ $result->submitted_count }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ url('/admin/verified-list/'.$result->Pref_Districts) }}">
                                        {{ $result->approved_count }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ url('/admin/rejected-list/'.$result->Pref_Districts) }}">
                                        {{ $result->rejected_count }}
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