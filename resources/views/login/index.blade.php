@extends('layout.main')

@section('container')
<main class="vh-100 d-flex justify-content-center">
    <div class="container px-5 my-5 px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    {{-- <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
                    <h1 class="h3 mb-3 fw-normal">Login</h1>

                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com"  autofocus>
                        <label for="email">Email address</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <!-- Password input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" type="password" name="password" placeholder="password" ->
                        <label for="password">Password</label>
                        <div class="invalid-feedback" data-sb-feedback="password:required">A password is required.</div>
                    </div>
                    <!-- Submit Button-->
                    <div class="d-grid"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Submit</button></div>
                </form>
                <small class="d-block text-center mt-3">Belum punya akun, <a href="/register">Daftar</a> </small>
            </div>
        </div>
    </div>
</main>
@endsection