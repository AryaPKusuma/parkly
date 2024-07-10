<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use App\Models\ContactUs;
use App\Models\ParkingLots;
use App\Models\Transactions;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();

        return view('adminreport',  compact('reports'));
    }

    public function message()
    {
        $contactUsMessages = ContactUs::all();

        return view('adminmessage',  compact('contactUsMessages'));
    }

    public function user()
    {
        // $user = User::all();
        $users = User::with('parkingLots')->get();

        return view('adminuser', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parkinglot_id' => 'required',
        ]);

        // $validatedData['image'] = $request->file('image')->store('public/report');

        $report = new Report();
        $report->description = $request->input('description');

        if ($request->hasFile('image')) {
            $report->image = $request->file('image')->store('public/report');
        } else {
            $report->image = null;
        }

        $report->parkinglot_id = $request->input('parkinglot_id');

        // Menyimpan data ke database
        $report->save();


        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah kami terima.');
    }

    public function show()
    {

        $reportCount = Report::count();
        $messageCount = ContactUs::count();
        $userCount = User::count();
        $parkiranCount = ParkingLots::count();

        $transactions = Transactions::select(DB::raw('DATE(transaction_date) as date'), DB::raw('COUNT(DISTINCT user_id) as total_users'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

            $labels = $transactions->pluck('date');
            $data = $transactions->pluck('total_users');


        return view('admin',  compact('userCount','parkiranCount', 'messageCount', 'reportCount', 'labels', 'data'));
    }


    public function deleteReport($id)
    {
        $report = Report::find($id);

        if ($report) {
            $report->delete();
            return redirect()->back()->with('success', 'Pesan berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Pesan tidak ditemukan');
        }
    }
}
