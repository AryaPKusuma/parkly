<?php

namespace App\Http\Controllers;

use App\Models\ParkingLots;
use App\Models\Reservation;
use App\Models\UserHistory;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input jika diperlukan
        $validatedData = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
            'parkinglot_id' => 'required',
        ]);

        Rating::create([
            'user_id' => auth()->user()->id,
            'rating' => $validatedData['rating'],
            'comment' => $validatedData['comment'],
            'parkinglot_id' => $validatedData['parkinglot_id'],
        ]);

        $parkinglotId = $request->parkinglot_id;
        $averageRating = Rating::where('parkinglot_id', $parkinglotId)->avg('rating');

        $parkinglot = ParkingLots::find($parkinglotId);

        if (!$parkinglot) {
            // Tindakan jika $parkinglotId tidak valid
            return redirect('/dashboard')->with('error', 'Data parkiran tidak ditemukan.');
        }

        $parkinglot->rating = $averageRating;
        $parkinglot->save();

        $id_user = Auth::user()->id;
        UserHistory::create([
            'user_id' => $id_user,
            'parkinglots_id' => $parkinglotId,
            'action' => 'Selesai',
        ]);

        $reservationid = $request->reservation_id;
        $reservation = Reservation::findOrFail($reservationid);
        $reservation->delete();

        return redirect()->back()->with('success', 'Rating telah berhasil disimpan.');
    }
}
