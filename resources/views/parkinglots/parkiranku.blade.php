@extends('layout.main')

@section('container')

<section class="vh-100" style="background-color: #eee;">

<div class="container py-5">
    <div class="card text-center">
    <div class="card-header">
        <h3>Daftar Parkiranku</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-sm text-center align-middle">
              <thead>
                <tr>
                  <th scope="col">Foto</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Kapasitas</th>
                  <th scope="col">Lokasi</th>
                  <th scope="col">Tarif</th>
                  <th scope="col">jadwal</th>
                  <th scope="col">Status</th>
                  <th scope="col">Hapus</th>
                  <th scope="col">Detail</th>
                  <th scope="col">Edit</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($parkiranku as $parkir)
                <tr>
                    <td><img src="{{ asset('storage/foto-parkiran/'.basename($parkir->photo)) }}" alt="Parking Photo" style="width: 100px"></td>
                    <td><small>{{ $parkir->parking_name }}</small></td>
                    <td><small>{{ $parkir->capacity }}</small></td>
                    <td><small>{{ $parkir->address }}</small></td>
                    <td><small>{{ $parkir->cost }}</small></td>
                    <td><small>{{ $parkir->jam_buka }} - {{ $parkir->jam_tutup }}</small></td>
                    @if( $parkir->status == 0)
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
                        <form action="{{ route('parkir.destroy', $parkir->idparking) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('parkinglot.show', ['parkinglot' => $parkir->idparking]) }}" class="btn btn-warning btn-sm">Detail</a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{ $parkir->idparking }}">Edit</button>
                    </td>
                </tr>
    {{--------------------   Modal -------------------}}
                    <div class="modal fade" id="myModal{{ $parkir->idparking }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Parkiran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        @if( $parkir->status == 0 )
                        <form method="POST" action="{{ route('parkinglot.update', ['parkinglot' => $parkir->idparking]) }}">
                            <div class="modal-body" style="background-color: #eee;">
                                <!-- Form edit data parkir -->
                                    @csrf
                                    @method('PUT')
                                    <!-- Kolom-kolom input untuk mengedit data -->
                                    <div class="form-group m-2">
                                        <label for="parking_name">Nama Tempat Parkir</label>
                                        <input type="text" class="form-control" id="parking_name" name="parking_name" value="{{ $parkir->parking_name }}" required>
                                    </div>
                                    <div class="form-group m-2">
                                        <label for="capacity">Kapasitas</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $parkir->capacity }}" required>
                                    </div>
                                    <div class="form-group m-2">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $parkir->address }}" required>
                                    </div>
                                    <div class="form-group m-2">
                                        <label for="cost">Biaya</label>
                                        <input type="number" class="form-control" id="cost" name="cost" value="{{ $parkir->cost }}" required>
                                    </div>
                                    <div class="form-group m-4">
                                        <label for="jam_buka">Set Jam Buka</label>
                                        <input type="time" name="jam_buka" id="jam_buka" class="form-control" value="{{ $parkir->jam_buka }}" required>
                                        <label for="jam_tutup">Set Jam Tutup</label>
                                        <input type="time" name="jam_tutup" id="jam_tutup" class="form-control" value="{{ $parkir->jam_tutup }}" required>
                                    </div>
                                    <div class="form-group m-2">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status1" value="1">
                                            <label class="form-check-label" for="status">
                                              Buka Parkiran
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status0" value="0" checked>
                                            <label class="form-check-label" for="status">
                                              Tutup parkiran
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group m-4">
                                        <label for="lonlat">Longitude Latitude</label>
                                        <input type="text" name="lonlat" id="lonlat" class="form-control" >
                                    </div>
                                    <div class="form-group m-2">
                                        <label for="photo">Foto</label>
                                        <input type="file" class="form-control-file" id="photo" name="photo">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            @else
                            <form method="POST" action="{{ route('parkinglot.update', ['parkinglot' => $parkir->idparking]) }}">
                                <div class="modal-body" style="background-color: #eee;">
                                    <!-- Form edit data parkir -->
                                        @csrf
                                        @method('PUT')
                                        <!-- Kolom-kolom input untuk mengedit data -->
                                        <div class="form-group m-4">
                                            <label for="parking_name">Nama Tempat Parkir</label>
                                            <input type="text" class="form-control" id="parking_name" name="parking_name" value="{{ $parkir->parking_name }}" required>
                                        </div>
                                        <div class="form-group m-4">
                                            <label for="capacity">Kapasitas</label>
                                            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $parkir->capacity }}" required>
                                        </div>
                                        <div class="form-group m-4">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ $parkir->address }}" required>
                                        </div>
                                        <div class="form-group m-4">
                                            <label for="cost">Biaya</label>
                                            <input type="number" class="form-control" id="cost" name="cost" value="{{ $parkir->cost }}" required>
                                        </div>
                                        <div class="form-group m-4">
                                            <label for="jam_buka">Set Jam Buka</label>
                                            <input type="time" name="jam_buka" id="jam_buka" class="form-control" value="{{ $parkir->jam_buka }}" required>
                                            <label for="jam_tutup">Set Jam Tutup</label>
                                            <input type="time" name="jam_tutup" id="jam_tutup" class="form-control" value="{{ $parkir->jam_tutup }}" required>
                                        </div>
                                        <div class="form-group m-4">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
                                                <label class="form-check-label" for="status">
                                                  Buka Parkiran
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status0" value="0" >
                                                <label class="form-check-label" for="status">
                                                  Tutup parkiran
                                                </label>
                                            </div>

                                        </div>
                                        <div class="form-group m-4">
                                            <label for="lonlat">Longitude Latitude</label>
                                            <input type="text" name="lonlat" id="lonlat" class="form-control" value="{{ $parkir->lonlat }}" >
                                        </div>
                                        <div class="form-group m-4">
                                            <label for="photo">Foto</label>
                                            <input type="file" class="form-control-file" id="photo" name="photo">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    </div>
                @endforeach
              </tbody>
            </table>

{{-------------        Tambahparkiran         ----------}}
            </div class="row justify-content-end">
            <div class="col-auto">
                <a class="btn btn-primary" href="/registrasi" role="button">Tambah Parkiran</a>
            </div>
        </div>
    </div>

    <div class="card text-center mt-3">
        {{-- <div class="card-header">

        </div> --}}
        <div class="card-body">
            <table class="table table-striped table-sm text-center align-middle">
                <thead>
                    <tr>
                        <th scope="col"><h3>History Pelanggan</h3></th>
                    </tr>
                </thead>
                <tbody>
                        @if ($history->isEmpty())
                        <tr>
                            <td>
                            <p class="mb-0 align-items-center text-center">Belum ada Riwayat.</p>
                            </td>
                        @else
                        @foreach ($history as $item)
                            <td>
                                <strong>{{ $item->user->name }}</strong> melakukan pemesanan parkiran di <strong>{{ $item->parkingLot->parking_name }}</strong>
                                pada tanggal {{ $item->created_at->format('d/m/Y H:i:s') }}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                </tbody>
            </table>
        </div>
    </div>

    </div>
</div>


</section>




<script>
    function detele(button) {
        var row = button.parentNode.parentNode;
        var table = row.parentNode.parentNode;
        var rowIndex = row.rowIndex;
        table.deleteRow(rowIndex);
    }
</script>
@endsection
