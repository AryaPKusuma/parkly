<?php

namespace App\Http\Controllers;

use App\Models\ParkingLots;
use App\Http\Requests\StoreParkingLotsRequest;
use App\Http\Requests\UpdateParkingLotsRequest;

class ParkingLotsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     $parkingLots = ParkingLots::all();
    //     return view('parkinglots.index', compact("parkingLots"));
    // }

    public function index()
    {
    $parkinglots = ParkingLots::all();
    return view('parkinglots.index', ['parkinglots' => $parkinglots]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParkingLotsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ParkingLots $parkingLots)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParkingLots $parkingLots)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParkingLotsRequest $request, ParkingLots $parkingLots)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkingLots $parkingLots)
    {
        //
    }
}
