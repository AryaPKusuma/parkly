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
                                            <a href="/user-favorite" class="nav-link active">
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
                            </nav>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="card mb-2">
                            <div class="card-body">
                                <strong>
                                    <h5>Tempat parkir favorite</h5>
                                </strong>
                            </div>
                        </div>

                    </div>
                    @foreach ($favorites as $favorite)
                        {{-- <div class="card mt-3 mb-3" style="background-color: #eee;"> --}}
                        <div class=" card mb-3 d-flex justify-content-center" style="background-color: #eee;">
                            <div class="row p-3 bg-white border rounded" style="background-color: #eee;">
                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                        src="{{ asset('storage/foto-parkiran/' . basename($favorite->parkingLot->photo)) }}"
                                        style="width: 250px; height: 120px"></div>
                                <div class="col-md-5 mt-1">
                                    <h5>{{ $favorite->parkingLot->parking_name }}</h5>
                                    <div class="d-flex flex-row">
                                        <div class="ratings mr-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $favorite->parkinglot->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-1 spec-1"><small>Kapasitas : </small><span
                                            class="dot"></span><small>{{ $favorite->parkinglot->capacity }}<br></small>
                                    </div>
                                    <div class="mt-1 mb-1 spec-1"><small>Alamat : </small><span
                                            class="dot"></span><small>{{ $favorite->parkinglot->address }}<br></small>
                                    </div>
                                </div>
                                <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                                    <div class="d-flex flex-row align-items-center">
                                        <h4 class="mr-1">Rp.{{ $favorite->parkingLot->cost }}</h4>
                                    </div>
                                    <small>
                                        @if ($favorite->parkinglot->status == 0)
                                            <td>
                                                <span class="badge badge-danger rounded-pill d-inline">Tutup</span>
                                            </td>
                                            <td>
                                            @else
                                            <td>
                                                <span class="badge badge-success rounded-pill d-inline">Buka</span>
                                            </td>
                                            <td>
                                        @endif
                                    </small>
                                    <br>
                                    <small>jadwal : {{ $favorite->parkinglot->jam_buka }} -
                                        {{ $favorite->parkinglot->jam_tutup }}</small>
                                    <div class="row p-0">

                                        @if ($favorite->parkinglot->status == 0)
                                            <button type="button" class="btn btn-sm  btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#my">
                                                Parkir
                                            </button>
                                            <a href="{{ route('parkinglot.show', ['parkinglot' => $favorite->parkinglot->idparking]) }}"
                                                class="btn btn-sm btn-secondary">Detail</a>
                                        @else
                                            <div class="col-4 m-0">
                                                <button type="button" class="btn btn-sm  btn-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#myModal{{ $favorite->parkinglot->idparking }}">
                                                    Parkir
                                                </button>
                                            </div>
                                            <div class="col-4 m-0">
                                                <a href="{{ route('parkinglot.show', ['parkinglot' => $favorite->parkinglot->idparking]) }}"
                                                    class="btn btn-sm btn-secondary">Detail</a>

                                            </div>
                                            <div class="col-4 m-0">
                                                <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-trash fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal fade" id="myModal{{ $favorite->parkinglot->idparking }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Parkir</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('reservation.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="police_number" class="form-label">Nomor Polisi</label>
                                                <input type="text" class="form-control" id="police_number"
                                                    name="police_number" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="vehicle_type" class="form-label">Jenis Kendaraan</label>
                                                <select class="form-select" id="vehicle_type" name="vehicle_type"
                                                    required>
                                                    <option selected disabled value="">Choose...</option>
                                                    <option>Motor</option>
                                                    <option>Mobil</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid state.
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="vehicle_brand" class="form-label">Merek Kendaraan</label>
                                                <input type="text" class="form-control" id="vehicle_brand"
                                                    name="vehicle_brand" required>
                                            </div>
                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                            <input type="hidden" name="parkinglots_id"
                                                value="{{ $favorite->parkinglot->idparking }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="my" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="text-center">
                                            <span>Parkiran Tutup, Coba lagi nanti !!</span>
                                        </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- </div>
        </div>
        </div>
        </div>
        </div> --}}
    </section>
@endsection
