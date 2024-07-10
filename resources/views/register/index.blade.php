@extends('layout.main')

@section('container')
<main class="vh-100 d-flex justify-content-center">
    <div class="container px-5 my-5 px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="/register" method="POST">
                    @csrf
                    {{-- <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
                    <h1 class="h3 mb-3 fw-normal">Daftar</h1>

                    <!-- Name input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" type="text" name="name" placeholder="name" data-sb-validations="required" autocomplete="off">
                        <label for="name">Full name</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" data-sb-validations="required,email" autocomplete="off">
                        <label for="email">Email address</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <!-- Phone number input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="notelp" type="text" name="notelp" placeholder="(123) 456-7890" data-sb-validations="required" autocomplete="off">
                        <label for="notelp">Phone number</label>
                        <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                    </div>
                    <!-- Password input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" type="password" name="password" placeholder="Enter your message here..." data-sb-validations="required">
                        <label for="password">Password</label>
                        <div class="invalid-feedback" data-sb-feedback="password:required">A password is required.</div>
                    </div>
                    <!-- Submit Button-->
                    <div class="d-grid"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Submit</button></div>
                </form>
                <small class="d-block text-center mt-3">Sudah punya akun ?, <a href="/login">Login</a> </small>
            </div>
        </div>
    </div>
</main>
@endsection