@extends('dashboard.layouts.main')

@section('container')
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4 mb-5">{{ $title }}</h2>
            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">{{ $title }}</li>
            </ol> --}}
            
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            
            <div class="card mb-4">
                <div class="card-header">
                    <a href="{{ url('/product/create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-circle-plus"></i>
                        add
                    </a>
                </div>
                <div class="card-body">
                    <table id="tableProduct">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>
                                        <a href="/product/{{ $item->id }}/edit" class="btn btn-warning btn-sm"><i
                                                class="fas fa-pencil-alt"></i></a>

                                        <form action="/product/{{ $item->id }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick=" return confirm('Are you sure?')"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    {{-- <div class="modal fade" id="productAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="tableAdd">
                        <tr>
                            <th>Product Name</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <input type="hidden" id="lastId" value="1">
                            <td>
                                <input type="text" id="products0" placeholder="Enter your product name"
                                    class="form-control">
                            </td>
                            <td>
                                <button name="addMore" id="addMore" class="btn btn-success btn-sm">Add More</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="save">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div> --}}

    <script>
        $(document).ready(function() {
            $('#tableProduct').dataTable();
        })

        var i = 0;
        var lastId = $('#lastId').val();
        $('#addMore').click(function() {
            ++i;
            ++lastId;
            $('#lastId').val(lastId)
            $('#tableAdd').append(
                `<tr>
                <td>
                    <input type="text"
                    id="products` + i + `" placeholder="Enter your product name"
                    class="form-control">
                </td>
                <td>
                    <button class="btn btn-danger btn-sm remove-table-row">Remove</button>
                </td>
            </tr>`
            )
        })

        $(document).on('click', '.remove-table-row', function() {
            $(this).parents('tr').remove();
        })

        // var i = 0;
        // var lastId = $('#lastId').val();
        // $('#addMore').click(function() {
        //     ++i;
        //     ++lastId;
        //     $('#lastId').val(lastId)
        //     $('#tableAdd').append(
        //         `<tr>
    //         <td>
    //             <input type="text"
    //             id="products` + i + `" placeholder="Enter your product name"
    //             class="form-control">
    //         </td>
    //         <td>
    //             <button class="btn btn-danger btn-sm remove-table-row">Remove</button>
    //         </td>
    //     </tr>`
        //     )
        // })

        // $(document).on('click', '.remove-table-row', function() {
        //     $(this).parents('tr').remove();
        // })

        // $('#save').click(function() {

        //     let product_name = [];
        //     let lastId = $('#lastId').val();
        //     for (let i = 0; i < lastId; i++) {
        //         product_name.push($('#products' + i).val())
        //     }

        //     console.log(product_name)
        //     let token = $("meta[name='csrf-token']").attr("content")

        //     $.ajax({
        //         type: 'POST',
        //         url: '{{ url('/product') }}',
        //         data: {
        //             'products_name': product_name,
        //             '_token': token
        //         },
        //         beforeSend: function() {
        //             $('.alert-danger').remove()
        //         },
        //         success: function(response) {
        //             if (response.status == 0) {
        //                 response.error.products_name
        //                 console.log(response.error)
        //                 // $('.modal-body').prepend(
        //                 //     `<div class="alert alert-danger">
    //                 //         `+error.each(function(val,index) {
        //                 //             val + index   
        //                 //         })+`

    //                 //     </div>`
        //                 // )
        //             }else{
        //                 console.log(response.data)
        //                 // $('#productAdd').modal('hide')
        //                 // $('.card-body').prepend(
        //                 //     `<div class="alert alert-success">
    //                 //         `+response.message+`<br>
    //                 //         `+response.data.each(function(val) {
        //                 //             val
        //                 //         })+`
    //                 //     </div>`
        //                 // )
        //             }
        //         }
        //     })

        // })
    </script>
@endsection
