@extends('layout.main')

@section('container')

    <section class="vh-100" style="background-color: #eee;">
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
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-1">
                            <nav class="m-1">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a href="/dashboard" class="nav-link active">
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
                        <div class="col-lg-3 mb-3">
                            <div class="card mt-3 mb-3">
                                <div class="card-body bg-warning text-light">
                                    Parkiran
                                    <h3>{{ $parkingCount }}</h3>
                                </div>
                                <div class="card-footer">
                                    {{-- <a href="/parkiranku" class="btn btn-sm btn-warning">
                                        selengkapnya
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <div class="card mt-3 mb-3">
                                <div class="card-body bg-primary text-light">
                                    Saldo
                                    <h3>{{ Auth::user()->deposit }}</h3>
                                </div>
                                <div class="card-footer">
                                    {{-- <a href="#" class="btn btn-sm btn-primary">
                                        selengkapnya
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <div class="card mt-3 mb-3">
                                <div class="card-body bg-danger text-light">
                                    Pengeluaran
                                    <h3>{{ $totalSpending }}</h3>
                                </div>
                                <div class="card-footer">
                                    {{-- <a href="/history" class="btn btn-sm btn-danger">
                                        selengkapnya
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <div class="card mt-3 mb-3">
                                <div class="card-body bg-success text-light">
                                    Keuntungan
                                    <h3>{{ $totalprofit }}</h3>
                                </div>
                                <div class="card-footer">
                                    {{-- <a href="/dashboard-bisnis" class="btn btn-sm btn-success">
                                        selengkapnya
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 custom-card" id="card1">
                        <div class="card-header">
                            <h4>Status parkir</h4>
                        </div>
                        <div class="card-body">
                            @if ($currentParking->isEmpty())
                                <div class="row">
                                    <div>
                                        <p>Tidak ada status parkir saat ini</p>
                                    </div>
                                @else
                                    @foreach ($currentParking as $parking)
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <p><strong>{{ $parking->parking_name }}</strong></p>
                                                <p class="mb-0">Nomor Parkir :
                                                    <strong>{{ $parking->parking_number }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row">
                                                    @if ($parking->status == 0)
                                                        <div class="m-1">
                                                            <form
                                                                action="{{ route('cancel-parking', ['id' => $parking->idreservation]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger">Batal</button>
                                                            </form>
                                                        </div>
                                                        <div class="m-1">
                                                            <button type="button" class="btn btn-sm btn-primary"
                                                                data-mdb-toggle="modal" data-mdb-target="#masukparkir">
                                                                Masuk
                                                            </button>
                                                        </div>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="masukparkir" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary text-light">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Pembayaran</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-mdb-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            {{-- <div class="text-center mb-3">
                                                                                <p>Bayar dulu sebelum masuk parkiran</p>
                                                                            </div> --}}
                                                                            <div class="col-8">
                                                                                <img class="img-fluid img-responsive rounded product-image"
                                                                                    src="{{ asset('storage/foto-parkiran/' . basename($parking->parkingLot->photo)) }}"
                                                                                    style="width: 100px; height: 50px">
                                                                                <br>
                                                                                <strong
                                                                                    class="mt-1"><small>{{ $parking->parking_name }}</small></strong>
                                                                            </div>
                                                                            <div class="col-4 d-flex justify-content-end">

                                                                                Saldo : {{ Auth::user()->deposit }}
                                                                                <br>
                                                                                Tarif : {{ $parking->parkingLot->cost }}

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-outline-primary"
                                                                            data-mdb-ripple-color="dark"
                                                                            data-mdb-dismiss="modal">Tutup
                                                                        </button>
                                                                        {{-- -  Tombol Pembayaran parkiran  - --}}
                                                                        <form action="{{ route('payment.process') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="parkinglot_id"
                                                                                value="{{ $parking->parkingLot->idparking }}">
                                                                            <input type="hidden" name="reservation_id"
                                                                                value="{{ $parking->idreservation }}">
                                                                            <button class="btn btn-primary btn-sm"
                                                                                type="submit">Checkout</button>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-mdb-toggle="modal"
                                                                data-mdb-target="#Modal{{ $parking->idreservation }}">
                                                                Keluar
                                                            </button>
                                                        </div>
                                                        <div class="modal fade" id="Modal{{ $parking->idreservation }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content modal-content-center">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Rating dan
                                                                            Ulasan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-mdb-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('ratings.store')}}"
                                                                            method="post">
                                                                            @csrf

                                                                            <h6>Berikan Rating</h6>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="rating"
                                                                                    id="inlineRadio1" value="1">
                                                                                <label class="form-check-label"
                                                                                    for="inlineRadio1"><i
                                                                                        class="fas fa-star"></i></label>
                                                                            </div>

                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="rating"
                                                                                    id="inlineRadio2" value="2">
                                                                                <label class="form-check-label"
                                                                                    for="inlineRadio2"><i
                                                                                        class="fas fa-star"></i></label>
                                                                            </div>

                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="rating"
                                                                                    id="inlineRadio3" value="3">
                                                                                <label class="form-check-label"
                                                                                    for="inlineRadio3"><i
                                                                                        class="fas fa-star"></i></label>
                                                                            </div>

                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="rating"
                                                                                    id="inlineRadio4" value="4">
                                                                                <label class="form-check-label"
                                                                                    for="inlineRadio4"><i
                                                                                        class="fas fa-star"></i></label>
                                                                            </div>

                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="rating"
                                                                                    id="inlineRadio5" value="5">
                                                                                <label class="form-check-label"
                                                                                    for="inlineRadio5"><i
                                                                                        class="fas fa-star"></i></label>
                                                                            </div>
                                                                            <input type="hidden" name="parkinglot_id"
                                                                                id="parkinglot_id"
                                                                                value="{{ $parking->parkinglots_id }}">
                                                                                <input type="hidden" name="reservation_id"
                                                                                id="reservation_id"
                                                                                value="{{ $parking->idreservation }}">
                                                                            <div class="mt-3">
                                                                                <h6>Berikan Ulasanmu</h6>
                                                                                <textarea name="comment" id="" cols="50" rows="8"></textarea>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-mdb-dismiss="modal">Tidak</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Kirim</button>
                                                                            </div>
                                                                    </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    {{-- <div>
                                                            <form
                                                                action="{{ route('cancel-parking', ['id' => $parking->idreservation]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger">Batal</button>
                                                            </form>
                                                        </div> --}}
                                                </div>

                                            </div>
                                            <hr>
                                    @endforeach
                            @endif
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
