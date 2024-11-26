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
                    <a href="{{ url('/stock/create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-circle-plus"></i>
                        Add
                    </a>
                </div>
                <div class="card-body">
                    <table id="tableStock">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Jumlah Sarang</th>
                                <th>Berat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Jumlah Sarang</th>
                                <th>Berat</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($stocks as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->jumlah_sarang }}</td>
                                    <td>{{ $item->berat }}</td>
                                    <td>
                                        <a href="/stock/{{ $item->id }}/edit" class="btn btn-warning btn-sm"><i
                                                class="fas fa-pencil-alt"></i></a>

                                        {{-- <form action="/stock/{{ $item->id }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick=" return confirm('Are you sure?')"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form> --}}
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
            $('#tableStock').dataTable();
        })
    </script>
@endsection
