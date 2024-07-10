@extends('layout.main')

@section('container')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-3">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-3" id="profile">
                        <div class="card-body text-center">
                            {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;"> --}}

                            @php
                                $photo = Auth::user()->photo;
                                $photoUrl = $photo ? asset('storage/photo-user/' . basename($photo)) : null;
                            @endphp


                            @if ($photoUrl)
                                <img src="{{ $photoUrl }}" alt="Photo" class="rounded-circle img-fluid"
                                    style="width: 150px; height: 150px;">
                            @else
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            @endif


                            {{-- <img src="{{ asset('storage/photo-user/' . basename(Auth::user()->photo)) }}" alt="Photo"
                                class="rounded-circle img-fluid" style="width: 150px; height: 150px;"> --}}
                            <h6 class="my-2">{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-1">
                            <nav class="m-1">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a href="/dashboard" class="nav-link">
                                            <i class="fa-solid fa-gauge fa-lg"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/user-detail" class="nav-link">
                                            <i class="fa-solid fa-lg fa-circle-info"></i>
                                            Detail User
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/user-favorite" class="nav-link">
                                            <i class="fa-solid fa-lg fa-heart"></i>
                                            Favorite
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/user-history" class="nav-link">
                                            <i class="fa-sharp fa-lg fa-solid fa-clock-rotate-left"></i>
                                            History
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/topup" class="nav-link active">
                                            <i class="fa-solid fa-lg fa-money-bill-1"></i>
                                            Top Up
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">

                    <div class="card mb-4" id="datauser">
                        <a class="btn btn-success btn-lg" href="https://wa.me/088901826534?text=Halo, Saya mau top up">Hubungi Whatsapp</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection





{{-- ------------------------ History --------------------- --}}
{{--
<div class="card mb-4 mb-lg-0">
  <div class="card-body p-0">
    <ul class="list-group list-group-flush rounded-3">
        @if ($history->isEmpty())
      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
        <p class="mb-0 align-items-center text-center">Belum ada history pemesanan.</p>
      </li>
      @else
      @foreach ($history as $item)
      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
          <p class="mb-0 text-center"><strong>{{ $item->user->name }}</strong> melakukan pemesanan parkiran di <strong>{{ $item->parkingLot->parking_name }}</strong>
              pada tanggal {{ $item->created_at->format('d/m/Y H:i:s') }}</p>
      </li>
      @endforeach
      @endif
    </ul>
  </div>
</div> --}}
