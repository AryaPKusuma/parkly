@extends('layout.main')

@section('container')

<div class="container py-3">
    <h4>Daftar Laporan</h4>

    @if ($reports !== null)
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tempat Parkir</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Tanggal Dibuat</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->parkingLot->parking_name }}</td>
                        <td>{{ $report->description }}</td>
                        <td>
                            <img src="{{ Storage::url($report->image) }}" alt="Report Image" width="100">
                        </td>
                        <td>{{ $report->created_at }}</td>
                        <td>
                          <form action="{{ route('delete-report', ['id' => $report->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-close"></button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada laporan yang tersedia.</p>
    @endif
</div>

@endsection
