@extends('layouts.main')

@section('container')
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Login</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.store') }}"> 
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control" id="id_user" type="text" name="id_user" value="{{ old('id_user') }}" placeholder="name@example.com" />
                        <label for="id_user">Email or Username</label>
                        @error('id_user')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" type="password" name="password" placeholder="Password" />
                        <label for="password">Password</label>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div>
            </div>
        </div>
    </div>
@endsection
