@extends('dashboard.layouts.main')

@section('container')
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4">{{ $title }}</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="{{ url('/barangmasuk') }}">Barang Masuk</a></li>
                <li class="breadcrumb-item">{{ $title }}</li>
            </ol>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ url('/barangmasuk') }}" method="post" id="form_add">
                        @csrf
                        <div class="mb-4 row">
                            <label for="inputDate" class="col-sm-2 col-form-label" id="required-field">Tanggal Masuk</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="inputDate" name="tanggal_masuk">
                                <small class="text-danger error-text date_error"></small>
                            </div>
                        </div>
                        <table class="table table-bordered" id="tableAdd">
                            <tr>
                                {{-- <th id="required-field">Date</th> --}}
                                <th id="required-field">Nama Produk</th>
                                <th id="required-field">Jumlah Sarang</th>
                                <th style="width: 15%">Berat</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="inputs[0][product_id]" class="form-control">
                                        <option value="">Please change one</option>
                                        @foreach ($products as $item)
                                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger error-text inputs_0_product_id_error "></small>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="inputs[0][jumlah_sarang]">
                                    <small class="text-danger error-text inputs_0_jumlahsarang_error "></small>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="inputs[0][berat]">
                                    <small class="text-danger error-text inputs_0_berat_error "></small>
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
                // <td>
                //     <input type="date" class="form-control" name="inputs[` + i + `][date]">
                //     <small class="text-danger error-text inputs_` + i + `_date_error "></small>
                // </td>
                `<tr>
                <td>
                    <select name="inputs[` + i + `][product_id]" class="form-control">
                                        <option value="">Please change one</option>
                                        @foreach ($products as $item) 
                                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                     <small class="text-danger error-text inputs_` + i + `_product_id_error "></small>
                </td>
                <td>
                    <input type="number" class="form-control" name="inputs[` + i + `][jumlah_sarang]">
                    <small class="text-danger error-text inputs_` + i + `_jumlahsarang_error "></small>
                </td>
                <td>
                    <input type="number" class="form-control" name="inputs[` + i + `][berat]">
                    <small class="text-danger error-text inputs_` + i + `_berat_error "></small>
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

                        $('.date_error').text(response.error.tanggal_masuk)

                        console.log(response)

                    }

                    if (response.status == 1) {
                        $('.card-body').prepend(
                            `<div class="alert alert-success">` + response.message + `</div>`
                        )

                        // console.log(response.data)

                        $('#form_add')[0].reset()
                        // window.location.replace("/barangmasuk");
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
