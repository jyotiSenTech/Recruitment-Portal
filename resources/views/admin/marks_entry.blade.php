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
                <form action="{{ route('admin.marks-entry') }}" method="post" enctype="multipart/form-data" id="myForm">
                    <div class="table-responsive container" style="margin-top: 20px; margin-bottom: 20px;">
                        <table id="datatable" class="table table-striped table-bordered cell-border">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Mobile Number</th>
                                    <th>Marks Entry (Max. 20)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($application_lists as $index => $application_list)
                                <tr>
                                    <td>{{ $application_list->Applicant_ID }}</td>
                                    <td>{{ $application_list->First_Name }}</td>
                                    <td>{{ $application_list->Contact_Number }}</td>
                                    <td>
                                        <input type="hidden" name="id[]" class="form-control" value="{{ $application_list->RowID }}">
                                        @if ($application_list->Test_Marks == 0)
                                        <input type="number" name="marks[]" class="form-control" max="20" min="0" required>
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                        @else
                                        <input type="number" name="marks[]" class="form-control" value="{{ $application_list->Test_Marks }}" readonly>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- <input type="Submit" value="Submit Marks" class="btn btn-info btn-lg"> -->
                        <button type="submit" class="btn btn-primary">Submit Marks</button>
                    </div>
                </form>
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

        //to add and remove class from input feild
        $('form input').keyup(function() {
            if (this.value) {
                var element = $(this);

                // Remove the is-invalid class from input elements
                element.removeClass('is-invalid');
                element.addClass('was-validated');
            } else {
                var element = $(this);
                var elementName = element.attr('name');

                if (elementName != "post" && elementName != "pehchan" && elementName != "samiti_name" && elementName != "panjiyan_no" && elementName != "total_member" && elementName != "house_no" && elementName != "demand" && elementName != "pond_name" && elementName != "khasra_no" && elementName != "rakba" && elementName != "amount")
                    if (element.length) {
                        // Remove the is-invalid class from input elements
                        element.removeClass('was-validated');
                        element.addClass('is-invalid');
                    }
            }
        });
    });

    $('#myForm').submit(function(e) {
        e.preventDefault(); // Prevent form from submitting normally

        var form = new FormData(this);
        var url = $(this).attr('action'); // Get the form action URL
        var csrf_token = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token value
        form.append('_token', '{{ csrf_token() }}');

        // Submit the form using AJAX
        $.ajax({
            url: url,
            type: "POST",
            data: form,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            context: this,
            success: function(data) {
                // Handle the response from the server
                console.log(data);
                if (data.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: data['message'],
                        // text: 'आवेदन की स्थिति को ट्रैक करने के लिए इस आईडी का उपयोग करें',
                        allowOutsideClick: false
                    }).then((data) => {
                        window.location.href = '/admin/marks-entry';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data['title'],
                        text: data['message'],
                        allowOutsideClick: false
                    })
                }
            },
            error: function(xhr, status, error) {
                // Handle the error
                console.log(xhr.responseText);
                Swal.fire({
                    icon: 'warning',
                    title: 'कृपया सभी आवश्यक फ़ील्ड भरें ! <br> (Please Fill All Required Field) ',
                    text: 'Please see fields marked in red....',
                    allowOutsideClick: false
                });

                var response = JSON.parse(xhr.responseText);
                // if (response.errors) {
                //     var errors = response.errors;
                //     var errorMessages = '';
                //     $.each(errors, function(key, value) {
                //         errorMessages += value[0] + '<br>';
                //         var element = $('[name="' + key + '"]');
                //         if (element.length) {
                //             element.addClass('is-invalid');
                //             element.parent().append('<div class="invalid-feedback">' + value[0] + '</div>');
                //         }
                //     });
                //     $('#error').html(errorMessages); // Display all error messages

                // }
            }
        });
    });
</script>
@endsection