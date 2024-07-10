<?php

namespace App\Http\Controllers;
use App\Models\UserHistory;
use App\Models\ParkingLots;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $parkinglot = ParkingLots::findOrFail($request->parkinglots_id);
        $id_user = Auth::user()->id;

        $capacity = $parkinglot->capacity;

        $usedParkingNumbers = Reservation::where('parkinglots_id', $parkinglot->idparking)->pluck('parking_number')->toArray();

        $availableParkingNumbers = [];
        for ($i = 1; $i <= $capacity; $i++) {
            if (!in_array($i, $usedParkingNumbers)) {
                $availableParkingNumbers[] = $i;
            }
        }

        if (empty($availableParkingNumbers)) {
            return redirect()->back();

            // ->with('error', 'Parkiran penuh. Mohon coba lagi nanti.');
        }

        $parkingNumber = $availableParkingNumbers[array_rand($availableParkingNumbers)];


        $validatedData = $request->validate([
            'police_number' => 'required',
            'vehicle_type' => 'required',
            'vehicle_brand' => 'required',
        ]);

        $validatedData['user_id'] = $id_user;
        $validatedData['parkinglots_id'] = $parkinglot->idparking;
        $validatedData['parking_name'] = $parkinglot->parking_name;
        $validatedData['parking_number'] = $parkingNumber;
        $validatedData['status'] = 0;

        Reservation::create($validatedData);

        // UserHistory::create([
        // 'user_id' => $id_user,
        // 'parkinglots_id' => $parkinglot->idparking,
        // 'action' => 'Booking',
        // ]);

        return redirect('/parkir')->with('succsess','Booking selesai dibuat.');

    }

    public function cancelParking($id)
    {
        $reservation = Reservation::findOrFail($id);

        $id_user = Auth::user()->id;
        UserHistory::create([
            'user_id' => $id_user,
            'parkinglots_id' => $reservation->parkinglots_id,
            'action' => 'Batal',
        ]);

        $reservation->delete();

        return redirect()->back()->with('success', 'Parkir berhasil dibatalkan.');
    }

}
