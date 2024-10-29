@extends('dashboard.layouts.main')

@section('container')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">{{ $title }}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="{{ url('/product') }}">Product</a></li>
                <li class="breadcrumb-item">{{ $title }}</li>
            </ol>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ url('/product') }}" method="post" id="form_add">
                        @csrf
                        <table class="table table-bordered" id="tableAdd">
                            <tr>
                                <th id="required-field">Product Name</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="products[]" placeholder="Enter your product name"
                                        class="form-control">
                                    <small class="text-danger error-text products_0_error "></small>
                                </td>
                                <td>
                                    <button type="button" id="addMore" class="btn btn-success">Add More</button>
                                </td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        var i = 0;
        $('#addMore').click(function() {
            ++i;
            $('#tableAdd').append(
                `<tr>
                <td>
                    <input type="text"
                    name="products[]" placeholder="Enter your product name" class="form-control">
                    <small class="text-danger error-text products_` + i + `_error"></small>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-table-row">Remove</button>
                </td>
            </tr>`
            )
        })

        $(document).on('click', '.remove-table-row', function() {
            $(this).parents('tr').remove();
        })


        $('#form_add').on('submit', function(e) {
            e.preventDefault()

            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('small.error-text').text('')
                },
                success: function(response) {
                    if (response.status == 0) {
                        $.each(response.error, function(prefix, val) {
                            $('small.' + prefix.replace(/[.]/g, '_') + '_error').text(val[0])
                        })

                    }

                    if (response.status == 1) {
                        $('.card-body').prepend(
                            `<div class="alert alert-success">` + response.message + `</div>`
                        )

                        $('#form_add')[0].reset()
                        // console.log(response.data)
                    }
                }
            })

        })
    </script>
@endsection

@push('form_add_product')
    <style>
        #required-field::after {
            content: "*";
            color: red;
        }
    </style>
@endpush
