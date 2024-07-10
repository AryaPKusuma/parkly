@extends('layout.main')

@section('container')

    <section style="background-color: #eee; mb-3">
        <div class="container py-3">
            <div class="row">
                <div class="col-lg-4 d-flex">
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex align-middle">
                                <img class="img-fluid img-responsive rounded" style=" height: 50%;"
                                    src="{{ asset('storage/foto-parkiran/' . basename($parkinglot->photo)) }}"
                                    alt="Parking Photo">
                            </div>
                        </div>
                        <div class="card-body text-center align-middle">
                            <h3>{{ $parkinglot->parking_name }}</h3>
                            <p><small>Capacity : {{ $parkinglot->capacity }}</small>
                                <br>
                                <small>Alamat : {{ $parkinglot->address }}</small>
                                <br>
                            </p>
                            <div class="row">
                                <div class="d-flex justify-content-center ">
                                    <h4><strong>Rp.{{ $parkinglot->cost }}</strong></h4>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#myModal{{ $parkinglot->idparking }}">Parkir</button>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <form action="{{ route('favorites.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="parkinglot_id" value="{{ $parkinglot->idparking }}">
                                        <button class="btn btn-primary" type="submit">Tambahkan ke Favorit</button>
                                    </form>
                                </div>

                                <div class="modal fade" id="myModal{{ $parkinglot->idparking }}" tabindex="-1"
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
                                                        <label for="vehicle_brand" class="form-label">Merek
                                                            Kendaraan</label>
                                                        <input type="text" class="form-control" id="vehicle_brand"
                                                            name="vehicle_brand" required>
                                                    </div>
                                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                    <input type="hidden" name="parkinglots_id"
                                                        value="{{ $parkinglot->idparking }}">
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

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#my"><i
                                        class="fas fa-triangle-exclamation"></i>
                                    <small>laporkan </small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Laporkan --}}
                <div class="modal fade" id="my" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                Laporkan {{ $parkinglot->parking_name }}
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <form method="POST" action="{{ route('report.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group m-3">
                                            <label for="description">Deskripsi</label>
                                            <textarea id="description" class="md-textarea form-control" name="description" rows="3"
                                                style="background-color: #eee;"></textarea>
                                        </div>
                                        <div class="form-group m-3">
                                            <label class="form-label" for="image">Tambahkan foto</label>
                                            <input type="file" class="form-control" id="image" name="image"
                                                style="background-color: #eee;" />
                                        </div>
                                        <div class="form-group m-3">
                                            <input id="parkinglot_id" type="hidden" name="parkinglot_id"
                                                value="{{ $parkinglot->idparking }}">
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex justify-content-end">
                                    <div class="m-2">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                    <div class="m-2">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 " style="max-height: 700px; overflow-y: auto;">
                    <div class="row">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Ketersediaan Tempat Parkir</h5>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    @for ($i = 1; $i <= $parkinglot->capacity; $i++)
                                        <div class="col-auto m-1 p-0">
                                            @if (in_array($i, $usedParkingNumbers))
                                                <?php $userId = $userIdsByParkingNumber[$i] ?? null; ?>
                                                <button class="btn bg-danger m-2 btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#my{{ $i }}">
                                                    No.{{ $i }}
                                                </button>
                                            @else
                                                <?php $userId = null; ?>
                                                <button class="btn bg-success m-2 btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#my{{ $i }}">
                                                    No.{{ $i }}
                                                </button>
                                            @endif
                                        </div>

                                        <div class="modal fade" id="my{{ $i }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p>Slot Parkir No.{{ $i }}</p>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (isset($userId))
                                                            <?php $user = \App\Models\User::find($userId); ?>
                                                            @if ($user)
                                                                <p>User ID: {{ $userId }}</p>
                                                                <p>Nama Pengguna: {{ $user->name }}</p>
                                                            @else
                                                                <p>Nama Pengguna: Tidak ditemukan</p>
                                                            @endif
                                                        @else
                                                            <p>Slot Parkir tersedia</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="d-flex justify-content-end">
                                                            <div class="m-2">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">

                            <iframe width="850" height="300"
                                src="https://maps.google.com/maps?q={{ $parkinglot->lonlat }}&output=embed">
                            </iframe>

                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>Rating dan Ulasan</h5>
                                <h1><strong>{{ $parkinglot->rating }}</strong></h1>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $parkinglot->rating)
                                        <i class="fas fa-star fa-lg text-warning"></i>
                                    @else
                                        <i class="far fa-star fa-lg text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="card-body">
                                @foreach ($parkinglot->ratings as $rating)
                                    <div class="border-bottom pb-2 mb-2">
                                        <p><strong>{{ $rating->user->name }}</strong>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rating->rating)
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                @else
                                                    <i class="far fa-star fa-sm text-warning"></i>
                                                @endif
                                            @endfor
                                        </p>

                                        <p><small>{{ $rating->comment }}</small></p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

{{-- @if ($i <= count($parkiranku)) bg-success @else bg-danger @endif mb-3" style="width: 8rem; --}}
