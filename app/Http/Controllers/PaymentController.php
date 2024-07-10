<?php

namespace App\Http\Controllers;

use App\Models\Parkinglot;
use App\Models\ParkinglotLog;
use App\Models\ParkingLots;
use App\Models\Reservation;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $id_user = Auth::user()->id;
        $user = User::find($id_user);
        $parkinglot = ParkingLots::find($request->parkinglot_id);


        // dd($user->deposit, $parkinglot->cost);
        if ($user->deposit < $parkinglot->cost) {
            return "saldomu tidak cukup, silahkan top up dulu";
        }

        // menambahkan keuntungan
        $user->deposit -= $parkinglot->cost;
        $parkinglot->profit += $parkinglot->cost;
        $user->save();
        $parkinglot->save();

        // Mencatat Pembayaran
        $transaction = new Transactions();
        $transaction->user_id = $user->id;
        $transaction->parkinglot_id = $parkinglot->idparking;
        $transaction->amount = $parkinglot->cost;
        // $transaction->transaction_type = 'payment';
        $transaction->transaction_date = now();
        $transaction->save();

        $reservation = Reservation::find($request->reservation_id);
        // dd($reservation->idreservation);
        if ($reservation) {
            $reservation->status = 1;
            $reservation->save();
        }


        // Mencatat pembayaran dalam tabel parkinglots_log
        $parkinglotLog = new ParkinglotLog();
        $parkinglotLog->parkinglot_id = $parkinglot->idparking;
        $parkinglotLog->user_id = $user->id;
        $parkinglotLog->amount = $parkinglot->cost;
        $parkinglotLog->parking_date = now();
        $parkinglotLog->save();

        return back()->with('success', 'Pembayaran berhasil.');
    }
}
