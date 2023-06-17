@extends('layout.admin')

@section('container')
<main class="vh-100 justify-content-center">
    <div class="container">
        <h1>Welcome To Menu Parkiranku</h1>
        <br>
        @auth
        <h4>Welcome, {{ Auth::user()->name }}</h4>
        <h5>Email : ({{ Auth::user()->email }})</h5>
        <h5>Phone : ({{ Auth::user()->notelp }})</h5>
        @endauth
    </div>
</main>



@endsection