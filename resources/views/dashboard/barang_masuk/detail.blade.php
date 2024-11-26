@extends('dashboard.layouts.main')

@section('container')
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">{{ $title }}</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('/barangmasuk') }}">Barang Masuk</a></li>
                <li class="breadcrumb-item">{{ $title }}</li>
                <li class="breadcrumb-item">{{ date('d F Y', strtotime($barangmasuk->tanggal_masuk)) }}</li>
            </ol>

            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card mb-4">

                <div class="card-body">
                    <table id="tableDetailBarangMasuk">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Sarang</th>
                                <th>Berat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Sarang</th>
                                <th>Berat</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($detail_barangmasuk as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->jumlah_sarang }}</td>
                                    <td>{{ $item->berat }}</td>
                                    <td>
                                        <button data-detailid="{{ $item->id }}"
                                            class="btn btn-warning btn-sm editBarangMasuk" data-bs-toggle="modal"
                                            data-bs-target="#editModal"><i class="fas fa-pencil-alt"></i></button>

                                        <form action="/barangmasuk/{{ $item->id }}" class="d-inline" method="POST">
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="detailId">
                        <div class="mb-3">
                            <label for="inputNamaProduk" class="form-label">Nama Produk</label>
                            <select name="" id="namaProduk" class="form-control"></select>
                            <small class="text-danger error-text namaProduk_error "></small>
                        </div>
                        <div class="mb-3">
                            <label for="jumlahSarang" class="form-label">Jumlah Sarang</label>
                            <input type="number" class="form-control" id="jumlahSarang">
                            <small class="text-danger error-text jumlahSarang_error "></small>
                        </div>
                        <div class="mb-3">
                            <label for="berat" class="form-label">Berat</label>
                            <input type="number" class="form-control" id="berat">
                            <small class="text-danger error-text berat_error "></small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary simpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tableDetailBarangMasuk').dataTable();

            $('.editBarangMasuk').click(function() {
                detailId = $(this).data('detailid')

                $.ajax({
                    method: 'get',
                    url: '/barangmasuk/' + detailId + '/edit',
                    dataType: 'json',
                    beforeSend: function() {
                        $(document).find('small.error-text').text(''),
                        $(document).find('#namaProduk').empty()
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            $('#detailId').val(response.data.detail_barangmasuk.id)

                            $('#jumlahSarang').val(response.data.detail_barangmasuk.jumlah_sarang)

                            $('#berat').val(response.data.detail_barangmasuk.berat)

                            barisProduk = ''
                            $.each(response.data.produk, function(prefix, val) {
                                if (response.data.detail_barangmasuk.product_id == val['id'] ) {
                                    barisProduk += '<option value="'+val['id']+'" selected>'+val['product_name']+' </option>'
                                }else{
                                     barisProduk += '<option value="'+val['id']+'">'+val['product_name']+' </option>'
                                }
                                
                            })

                            $('#namaProduk').append(barisProduk)
                        }

                        // if (response.status == 1) {
                        //     $('.card-body').prepend(
                        //         `<div class="alert alert-success">` + response.message +
                        //         `</div>`
                        //     )

                        //     // console.log(response.data)

                        //     $('#form_add')[0].reset()
                        //     // window.location.replace("/barangmasuk");
                        // }
                    }
                })

            })

            $('.simpan').click(function() {
                $.ajax({
                    method: 'put',
                    url: '/barangmasuk/' + detailId,
                    dataType: 'json',
                    beforeSend: function() {
                        $(document).find('small.error-text').text(''),
                        $(document).find('#namaProduk').empty()
                    },
                    success: function(response) {
                        
                    }
                })
            })
        })
    </script>
@endsection
