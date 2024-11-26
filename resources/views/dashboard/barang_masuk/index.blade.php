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
                    <a href="{{ url('/barangmasuk/create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-circle-plus"></i>
                        Add
                    </a>
                </div>
                <div class="card-body">
                    <table id="tableBarangMasuk">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Masuk</th>
                                <th>Total Sarang</th>
                                <th>Total Berat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Masuk</th>
                                <th>Total Sarang</th>
                                <th>Total Berat</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($barang_masuk as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d F Y', strtotime($item->tanggal_masuk)) }}</td>
                                    <td>{{ $item->total_sarang }}</td>
                                    <td>{{ $item->total_berat }}</td>
                                    <td>
                                        <a href="/barangmasuk/{{ $item->id }}" class="btn btn-primary btn-sm"><i
                                                class="fas fa-eye"></i></a>

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

    <script>
        $(document).ready(function() {
            $('#tableBarangMasuk').dataTable();
        })
    </script>
@endsection