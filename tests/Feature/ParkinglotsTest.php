<?php

use App\Models\User;
use App\Models\ParkingLots;

it('has parkir page', function () {
    $response = $this->get('/parkir');

    $response->assertStatus(200);
});

it('user can rent a parkinglot', function () {
    $response = $this->post('/authenticate', [
        'email' => 'aryakusuma0703@gmail.com',
        'password' => 'arya123',
    ]);

    $response->assertRedirect('/home');
    $user = User::where('email', 'aryakusuma0703@gmail.com')->first();
    $parkingLot = ParkingLots::firstWhere('parking_name', 'Parking Corner');

    $this->actingAs($user);

    $requestData = [
        'parkinglots_id' => $parkingLot->idparking,
        'police_number' => 'B 1234 CD',
        'vehicle_type' => 'Car',
        'vehicle_brand' => 'Toyota',
    ];

    $response = $this->actingAs($user)->post('/reservations/store', $requestData);

    $response->assertRedirect('/parkir');
    $response->assertSessionHas('succsess', 'Booking selesai dibuat.');

    $this->assertDatabaseHas('reservations', [
        'user_id' => $user->id,
        'parkinglots_id' => $parkingLot->idparking,
        'police_number' => 'B 1234 CD',
        'vehicle_type' => 'Car',
        'vehicle_brand' => 'Toyota',
        'status' => 0,
    ]);

});

