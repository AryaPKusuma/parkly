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

    // Create a parking lot for reservation
    $parkingLot = ParkingLots::firstWhere('parking_name', 'Parking Corner');

    // Authenticate as the user
    $this->actingAs($user);

    // Mock request data
    $requestData = [
        'parkinglots_id' => 2,
        'police_number' => 'B 1234 CD',
        'vehicle_type' => 'Car',
        'vehicle_brand' => 'Toyota',
    ];

    // Mock the request with validated data
    $response = $this->actingAs($user)->post('/reservations/store', $requestData);

    // Assert redirection to '/parkir'
    $response->assertRedirect('/parkir');
    $response->assertSessionHas('succsess', 'Booking selesai dibuat.');

    // Assert that the reservation is stored in the database
    $this->assertDatabaseHas('reservations', [
        'user_id' => $user->id,
        'parkinglots_id' => 2,
        'police_number' => 'B 1234 CD',
        'vehicle_type' => 'Car',
        'vehicle_brand' => 'Toyota',
        'status' => 0,
    ]);

});

