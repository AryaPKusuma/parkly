@extends('layout.main')

@section('container')

    <section style="background-color: #eee;">
        <div class="container">
            <div class="mt-3">
                <form action="{{ route('parkinglot.index') }}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="input-group m-1">
                                <input type="search" class="form-control rounded" name="nama" id="nama"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="input-group m-1">
                                <div class="form-outline">
                                    <input style="background-color: #ffffff;" class="form-control" type="text"
                                        name="kota" id="kota" placeholder="Kota">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-2">
                            <div class="input-group m-1">
                                <div class="form-outline">
                                    <input style="background-color: #ffffff;" class="form-control" type="number"
                                        name="kapasitas" id="kapasitas" placeholder="kapasitas minimum">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="input-group m-1">
                                <select class="form-select" aria-label="Default select example" name="biaya"
                                    id="biaya">
                                    <option value="Termurah">Termurah</option>
                                    <option value="Termahal">Termahal</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 mt-1">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                </form>
            </div>

            @if ($hasilPencarian->isEmpty())
                @foreach ($parkinglots as $item)
                    {{-- <div class="card mt-3 mb-3"> --}}
                    <div class="card mt-3 mb-3 d-flex justify-content-center row">
                        <div class="col-md-12">
                            <div class="row p-3 bg-white border rounded">
                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                        src="{{ asset('storage/foto-parkiran/' . basename($item->photo)) }}"
                                        style="width: 250px; height: 120px"></div>
                                <div class="col-md-6 mt-1">
                                    <h5>{{ $item->parking_name }}</h5>
                                    <div class="d-flex flex-row">
                                        <div class="ratings mr-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $item->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-1 spec-1"><small>Kapasitas : </small><span
                                            class="dot"></span><small>{{ $item->capacity }}<br></small>
                                    </div>
                                    <div class="mt-1 mb-1 spec-1"><small>Alamat : </small><span
                                            class="dot"></span><small>{{ $item->address }}<br></small></div>
                                </div>
                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                    <div class="d-flex flex-row align-items-center">
                                        <h4 class="mr-1">Rp.{{ $item->cost }}</h4>
                                    </div>
                                    <small>Buka {{ $item->jam_buka }} - {{ $item->jam_tutup }}</small>
                                    <small>
                                        @if ($item->status == 0)
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
                                    <div class="col">
                                        @if ($item->status == 0)
                                            <button type="button" class="btn btn-sm  btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#my">
                                                Parkir
                                            </button>
                                            <a href="{{ route('parkinglot.show', ['parkinglot' => $item->idparking]) }}"
                                                class="btn btn-sm btn-secondary mt-2">Detail</a>
                                        @else
                                            <button type="button" class="btn btn-sm  btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#myModal{{ $item->idparking }}">
                                                Parkir
                                            </button>
                                            <a href="{{ route('parkinglot.show', ['parkinglot' => $item->idparking]) }}"
                                                class="btn btn-sm btn-info mt-2">Detail</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="myModal{{ $item->idparking }}" tabindex="-1"
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
                                            <input type="text" class="form-control form-control-sm" id="police_number"
                                                name="police_number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vehicle_type" class="form-label">Jenis Kendaraan</label>
                                            <select class="form-select form-select-sm" id="vehicle_type"
                                                name="vehicle_type" required>
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
                                            <input type="text" class="form-control form-control-sm" id="vehicle_brand"
                                                name="vehicle_brand" required>
                                        </div>
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <input type="hidden" name="parkinglots_id" value="{{ $item->idparking }}">
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
            @else
                @foreach ($hasilPencarian as $item)
                    {{-- <div class="card mt-3 mb-3" style="background-color: #eee;"> --}}
                    <div class=" card mt-3 mb-3 d-flex justify-content-center row" style="background-color: #eee;">
                        <div class="col-md-12">
                            <div class="row p-3 bg-white border rounded" style="background-color: #eee;">
                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                        src="{{ asset('storage/foto-parkiran/' . basename($item->photo)) }}"
                                        style="width: 250px; height: 120px"></div>
                                <div class="col-md-6 mt-1">
                                    <h5>{{ $item->parking_name }}</h5>
                                    <div class="d-flex flex-row">
                                        <div class="ratings mr-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $item->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-1 spec-1"><small>Kapasitas : </small><span
                                            class="dot"></span><small>{{ $item->capacity }}<br></small>
                                    </div>
                                    <div class="mt-1 mb-1 spec-1"><small>Alamat : </small><span
                                            class="dot"></span><small>{{ $item->address }}<br></small></div>
                                </div>
                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                    <div class="d-flex flex-row align-items-center">
                                        <h4 class="mr-1">Rp.{{ $item->cost }}</h4>
                                    </div>
                                    <small>
                                        @if ($item->status == 0)
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
                                    <small>jadwal : {{ $item->jam_buka }} - {{ $item->jam_tutup }}</small>
                                    <div class="col">

                                        @if ($item->status == 0)
                                            <button type="button" class="btn btn-sm  btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#my">
                                                Parkir
                                            </button>
                                            <a href="{{ route('parkinglot.show', ['parkinglot' => $item->idparking]) }}"
                                                class="btn btn-sm btn-secondary mt-2">Detail</a>
                                        @else
                                            <button type="button" class="btn btn-sm  btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#myModal{{ $item->idparking }}">
                                                Parkir
                                            </button>
                                            <a href="{{ route('parkinglot.show', ['parkinglot' => $item->idparking]) }}"
                                                class="btn btn-sm btn-outline-primary mt-2">Detail</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="myModal{{ $item->idparking }}" tabindex="-1"
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
                                            <input type="text" class="form-control form-control-sm" id="police_number"
                                                name="police_number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vehicle_type" class="form-label">Jenis Kendaraan</label>
                                            <select class="form-select form-select-sm" id="vehicle_type"
                                                name="vehicle_type" required>
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
                                            <input type="text" class="form-control form-control-sm" id="vehicle_brand"
                                                name="vehicle_brand" required>
                                        </div>

                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <input type="hidden" name="parkinglots_id" value="{{ $item->idparking }}">
                                    </div>
                                    <div class="modal-footer ">
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
            @endif

    </section>
@endsection
