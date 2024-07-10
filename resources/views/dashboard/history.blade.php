@extends('layout.main')

@section('container')

    <section style="background-color: #eee;">
        <div class="container py-3">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-3" id="profile">
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h6 class="my-2">{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    <div class="card mb-2 mb-lg-0">
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
                                        <a href="/user-history" class="nav-link active">
                                            <i class="fa-sharp fa-lg fa-solid fa-clock-rotate-left"></i>
                                            History
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
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
                    <div class="row">
                        <div class="card mb-2">
                            <div class="card-header ">
                                <div class="row">
                                    <div class="col-9">
                                        <strong><h4>Riwayat Parkir</h4></strong>
                                    </div>
                                    <div class="col-3">

                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($history->isEmpty())
                            <div class="col-12">
                                <div class="text-center">
                                    <br>
                                    <br>
                                    <h4>Riwayat Kosong</h4>
                                </div>
                            </div>
                        @else
                            @foreach ($history as $item)
                                <div class="card mt-2 ">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-10">
                                                <strong>Parkir</strong>
                                                <br>
                                                <small>{{ $item->created_at->format('d-m-Y | H:i') }}</small>
                                                {{--  --}}
                                            </div>
                                            <div class="col-1 m-auto">

                                                @if ($item->action == 'Selesai parkir')
                                                    <span class="badge rounded-pill badge-success">Selesai</span>
                                                @else
                                                    <span class="badge rounded-pill badge-danger">Batal</span>
                                                @endif
                                            </div>
                                            <div class="col-1 m-auto">
                                                <form action="{{ route('history.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light" data-mdb-ripple-color="dark">
                                                        <i class="fa-solid fa-trash fa-lg"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-2 mt-1">
                                                    <img class="img-fluid img-responsive rounded product-image"
                                                    src="{{ asset('storage/foto-parkiran/' . basename($item->parkingLot->photo)) }}"
                                                    style="width: 100px; height: 50px">
                                            </div>
                                            <div class="col-8">
                                                <small><strong>{{ $item->parkingLot->parking_name }}</strong></small>
                                                <br>
                                                <small>Kapasitas : {{ $item->parkingLot->capacity }}</small>
                                            </div>
                                            <div class="col-2">
                                                <small><span>Tarif</span></small>
                                                <small><strong>Rp.{{ $item->parkingLot->cost }}</strong></small>
                                                <br>
                                                {{-- <button class="btn btn-sm btn-primary">Pakir Lagi</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
