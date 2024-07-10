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
                                        <a href="/user-detail" class="nav-link active">
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
                                        <a href="/topup" class="nav-link">
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
                        @auth
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Phone</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ Auth::user()->notelp }}</p>
                                    </div>
                                </div>

                            </div>
                        @endauth
                    </div>
                    <div class="d-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-mdb-toggle="modal"
                            data-mdb-target="#exampleModal">
                            Upload Foto
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Foto</h5>
                                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('uploadPhoto') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="photo">Foto</label>
                                                <input type="file" name="photo" id="photo" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Unggah</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-mdb-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
