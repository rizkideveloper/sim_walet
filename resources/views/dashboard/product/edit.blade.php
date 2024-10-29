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
                    <form action="/product/{{ $product->id }}" method="post" id="form_edit">
                        @csrf
                        @method('PUT')
                        <table class="table table-bordered" id="tableAdd">
                            <tr>
                                <th id="required-field">Product Name</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="product_name" placeholder="Enter your product name"
                                        class="form-control" value="{{ $product->product_name }}">
                                    <small class="text-danger error-text product_name_error "></small>
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
        
        $('#form_edit').on('submit', function(e) {
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
                            $('small.product_name_error').text(response.error.product_name)
                
                    }

                    if (response.status == 1) {
                        // $('.card-body').prepend(
                        //     `<div class="alert alert-success">` + response.message + `</div>`
                        // )

                        window.location.href = '/product';
                        // $('#form_edit')[0].reset()
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
