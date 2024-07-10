@extends('layout.main')

@section('container')

<div class="container py-3 d-flex justify-content-center">
            <div class="card col-8 ">
                <div class="card-header"><h3>Tambah Tempat Parkir</h3></div>

                    <div class="card-body" style="background-color: #eee;">

                    <form method="POST" action="{{ route('registrasi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-12 mt-2 mb-2">
                                <div class="form-group m-2">
                                    <label for="parking_name">Nama Parkiran</label>
                                    <input type="text" name="parking_name" id="parking_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-6 mt-2 mb-2">
                                <div class="form-group m-2">
                                    <label for="capacity">Kapasitas</label>
                                    <input type="number" name="capacity" id="capacity" class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-6 mt-2 mb-2">
                                <div class="form-group m-2">
                                    <label for="cost">Harga</label>
                                    <input type="number" name="cost" id="cost" class="form-control form-control-sm" step="500" required>
                                </div>
                            </div>

                            <div class="col-12 mt-2 mb-2">
                                <div class="form-group m-2">
                                    <label for="address">Alamat</label>
                                    <input type="text" name="address" id="address" class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-6 mt-2 mb-2">
                                <div class="form-group m-2">
                                    <label for="jam_buka">Set Jam Buka</label>
                                    <input type="time" name="jam_buka" id="jam_buka" class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-6 mt-2 mb-2">
                                <div class="form-group m-2">
                                    <label for="jam_tutup">Set Jam Tutup</label>
                                    <input type="time" name="jam_tutup" id="jam_tutup" class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group m-2">
                                    <label for="lonlat">Longitude Latitude</label>
                                    <input type="text" name="lonlat" id="lonlat" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-4">
                            {{-- <label for="cost">Status</label> --}}
                            <input type="hidden" name="status" id="status" class="form-control" value="0" required>
                        </div>
                        <div class="form-group m-4">
                            <label for="photo">Upload foto tempat parkir</label>
                            <br>
                            <small>ukuran max 2Mb</small>
                            <br>
                            <input type="file" name="photo" id="photo" class="form-control-file">
                        </div>
                        {{-- @auth
                        <div class="form-group"><input type="hidden" name="user_id" value="{{ Auth::user()->id }}"></div>
                        @endauth --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-danger" href="/parkiranku" role="button">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
</div>

@endsection

{{-- action="{{ route('parkinglots.store') }}" method="POST" enctype="multipart/form-data" --}}
