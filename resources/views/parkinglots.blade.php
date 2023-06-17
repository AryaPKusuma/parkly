@extends('layout.main')

@section('container')
 
<div class="container">
    {{-- @foreach ($parkingLots as $parkinglot)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $parkinglot->parking_name }}</h5>
            <p class="card-text">Capacity: {{ $parkinglot->capacity }}</p>
            <p class="card-text">Address: {{ $parkinglot->address }}</p>
            <p class="card-text">Cost: {{ $parkinglot->cost }}</p>
            <p class="card-text">User ID: {{ $parkinglot->users_id }}</p>
        </div>
    </div>
@endforeach --}}

<div class="card" style="width: 18rem;">
    {{-- <img src="..." class="card-img-top" alt="..."> --}}
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>

</div>

@endsection