<?php

namespace App\Http\Controllers;

use App\Models\ParkingLots;
use App\Models\Transactions;
use App\Models\Reservation;
use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        // $history = UserHistory::with('user', 'parkingLot')->orderBy('created_at', 'desc')->get();
        // $currentParking = Reservation::where('user_id', $user->id)->first();


        $history = UserHistory::where('user_id', $user)->orderBy('created_at')->get();

        // , 'desc'
        // $currentParking = auth()->user()->reservations;
        $currentParking = auth()->user()->reservations;

        $parkingCount = ParkingLots::where('user_id', $user)->count();

        $totalSpending = Transactions::where('user_id', $user)
        ->sum('amount');

        $totalprofit = ParkingLots::where('user_id', $user)->sum('profit');

        return view('dashboard.index', compact('history', 'totalSpending','currentParking', 'parkingCount', 'totalprofit'));

        // return view('dashboard.index', compact('deposit'));
    }

    public function history()
    {
        $user = Auth::user()->id;

        $history = UserHistory::where('user_id', $user)->orderBy('created_at')->get();

        return view('dashboard.history', compact('history'));
    }

    public function destroyAllHistory()
    {
        $user_id = Auth::id();

        // Cari user berdasarkan id
        $user = User::find($user_id);

        // Jika user tidak ditemukan, kembalikan response error
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Hapus seluruh riwayat berdasarkan user_id
        UserHistory::where('user_id', $user_id)->delete();

        return redirect()->back()->with('success', 'Data parkir berhasil dihapus');
    }

    public function destroyHistory($id)
    {
        $history = UserHistory::findOrFail($id);
        $history->delete();

        return redirect()->back()->with('success', 'History berhasil dihapus');
    }

    public function showBarChart()
    {
        $user_id = Auth::user()->id;

        // Bar Chart
        $parkingLots = ParkingLots::where('user_id', $user_id)->get();
        $labels = $parkingLots->pluck('parking_name');
        $data = $parkingLots->pluck('profit');

        // Line Chart
        $transactions = Transactions::selectRaw('SUM(amount) AS total_amount, MONTH(transaction_date) AS month')
            ->whereYear('transaction_date', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels_line = $transactions->pluck('month')->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });

        $data_line = $transactions->pluck('total_amount');

        // Donat
        $parkingLots = ParkingLots::all();
        $labels_donat = $parkingLots->pluck('parking_name');
        $data_donat = [];

        foreach ($parkingLots as $parkingLot) {
            $userCount = Reservation::where('parkinglots_id', $parkingLot->id)
                ->where('status', 1)
                ->count();

            $data_donat[] = $userCount;
        }

        $labels_donat = json_encode($labels_donat);
        $data_donat = json_encode($data_donat);

        // Perhitungan
        $parkingCount = ParkingLots::where('user_id', $user_id)->count();
        $totalprofit = ParkingLots::where('user_id', $user_id)->sum('profit');
        $currentDateTime = Carbon::now();
        $totalParkers = Reservation::where('status', 1)
            ->where('created_at', '<=', $currentDateTime)
            // ->where('end_time', '>=', $currentDateTime)
            ->count();



        return view('dashboard.bussines', compact(
            'labels',
            'data',
            'labels_line',
            'data_line',
            'data_donat',
            'labels_donat',
            'parkingCount',
            'totalprofit',
            'totalParkers',
        ));
    }
}
