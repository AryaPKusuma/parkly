@extends('layout.main')

@section('container')

<div class="container py-3" >
    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Parkiran</th>
                            <th>Keuntungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <ul>
                                        @foreach($user->parkingLots as $parkingLot)
                                            <li>{{ $parkingLot->parking_name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach($user->parkingLots as $parkingLot)
                                            <li>{{ $parkingLot->profit }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('deleteUser', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
