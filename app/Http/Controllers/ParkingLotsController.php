<?php

namespace App\Http\Controllers;

use App\Models\ParkingLots;
use App\Models\Reservation;
use App\Models\UserHistory;
use App\Models\Favorite;
use App\Models\User;
use App\Http\Requests\StoreParkingLotsRequest;
use App\Http\Requests\UpdateParkingLotsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\NullableType;

class ParkingLotsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parkinglots = ParkingLots::all();

        $kota = $request->input('kota');
        $biaya = $request->input('biaya');
        $nama = $request->input('nama');
        $kapasitas = $request->input('kapasitas');

        // Query Builder untuk mendapatkan semua data parkiran
        $query = ParkingLots::query();

        // Query Builder untuk mencari parkiran berdasarkan kota
        if ($kota != 'Semua') {
            $query->where('address', 'LIKE', "%{$kota}%");
        }

        // Query Builder untuk mencari parkiran berdasarkan nama
        if (!empty($nama)) {
            $query->where('parking_name', 'LIKE', "%{$nama}%");
        }

        // kapasitas
        if (!empty($kapasitas)) {
            $query->where('capacity', '>=', $kapasitas);
        }

        // Query Builder untuk mengurutkan data parkiran berdasarkan biaya
        if ($biaya == 'Termurah') {
            $query->orderBy('cost', 'asc');
        } elseif ($biaya == 'Termahal') {
            $query->orderBy('cost', 'desc');
        }

        // Lakukan pencarian dengan query yang telah dibangun
        $hasilPencarian = $query->get();

        return view('parkinglots.index', compact('parkinglots', 'hasilPencarian'));
    }

     public function form()
    {
    return view('parkinglots.create');
    }

    // $parkiranku = auth()->user()->parkir;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('parkinglots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect('/parkiranku')->with('succsess','Parkir selesai dibuat.');
    }

    /**
     *********************** Detail. ***********************************
     */
    public function show(ParkingLots $parkinglot)
    {
        $parkinglot = ParkingLots::findOrFail($parkinglot->idparking);
        $capacity = $parkinglot->capacity;
        $usedParkingNumbers = Reservation::where('parkinglots_id', $parkinglot->idparking)->pluck('parking_number')->toArray();

        $userIdsByParkingNumber = [];
        $availableParkingNumbers = [];
        for ($i = 1; $i <= $capacity; $i++) {
            if (!in_array($i, $usedParkingNumbers)) {
                $availableParkingNumbers[] = $i;
            }else {
                $userId = Reservation::where('parkinglots_id', $parkinglot->idparking)
                ->where('parking_number', $i)
                ->value('user_id');
                $userIdsByParkingNumber[$i] = $userId;
            }
        }

        if (empty($availableParkingNumbers)) {
            return redirect()->back()->with('error', 'Parkiran penuh. Mohon coba lagi nanti.');
        }

        return view('parkinglots.detail', compact('parkinglot', 'usedParkingNumbers', 'userIdsByParkingNumber'));
    }



    public function edit(ParkingLots $parkinglot)
    {
        //
    }


    public function update(Request $request, ParkingLots $parkinglot)
    {
        $validatedData = $request->validate([
        'parking_name' => 'required',
        'capacity' => 'required|integer',
        'address' => 'required',
        'cost' => 'required|integer',
        'status' => 'required|integer',
        'jam_buka' => 'nullable',
        'jam_tutup' => 'nullable',
        'lonlat' => 'nullable',

    ]);

    $parkinglot->update($validatedData);
    return redirect()->back()->with('success', 'Data parkir berhasil diperbarui');
    }


    // ------------------------------- Delete ---------------------------------------
    public function destroy($idparking)
    {
    $parkir = ParkingLots::findOrFail($idparking);
    $parkir->delete();

    return redirect()->back()->with('success', 'Data parkir berhasil dihapus');
    }


}
