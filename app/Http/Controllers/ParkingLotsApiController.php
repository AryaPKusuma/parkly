<?php

namespace App\Http\Controllers;

use App\Models\ParkingLots;
// use App\Models\Reservation;
// use App\Models\UserHistory;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkingLotsApiController extends Controller
{
    public function index(Request $request)
    {
        $parkinglots = ParkingLots::all();

        return response()->json($parkinglots, 200 );
    }

    public function show(ParkingLots $parkinglot)
    {
        $parkinglot = ParkingLots::findOrFail($parkinglot->idparking);

        return response()->json($parkinglot, 200);
    }

    public function store(Request $request)
    {

        $id_user = Auth::user()->id;

        $validatedData = $request->validate([
            'parking_name' => 'required',
            'capacity' => 'required|integer',
            'address' => 'required',
            'cost' => 'required | integer',
            'photo' => 'required | image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'jam_buka' => 'nullable',
            'jam_tutup' => 'nullable',
            'lonlat' => 'nullable',
        ]);

        $validatedData['photo'] = $request->file('photo')->store('public/foto-parkiran');
        $validatedData['user_id'] = $id_user;

        ParkingLots::create($validatedData);

        return response()->json($validatedData, 200);
    }

    public function myparkir()
    {
        $user = Auth::user();
        $parkiranku = $user->parkir;

        $parkingLotIds = $user->parkir->pluck('idparking');

        $history = UserHistory::with(['user', 'parkingLot', 'parkingLot.reservations'])
            ->whereHas('parkingLot.reservations', function ($query) use ($parkingLotIds) {
                $query->whereIn('idparking', $parkingLotIds);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('parkinglots.parkiranku', compact('parkiranku', 'history'));
    }

}
