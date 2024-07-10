@extends('layout.main')

@section('container')
    <div class="container py-3">
        <div class="row">
            @foreach ($contactUsMessages as $message)
                <div class="card-header">
                </div>
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-11">
                            <table>
                                <tr>
                                    <th><small>Nama:</small></th>
                                    <td><small>{{ $message->name }}</small></td>
                                </tr>
                                <tr>
                                    <th><small>Email:</small></th>
                                    <td><small>{{ $message->email }}</small></td>
                                </tr>
                                <tr>
                                    <th><small>Subjek:</small></th>
                                    <td><small>{{ $message->subject }}</small></td>
                                </tr>
                                <tr>
                                    <th><small>Pesan:</small></th>
                                    <td>
                                        <div class="form-outline">
                                            <small>
                                                <textarea id="message" name="message" rows="3" cols="50" readonly>{{ $message->message }}</textarea>
                                            </small>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-1">
                            <form action="{{ route('delete-message', ['id' => $message->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-close"></button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
