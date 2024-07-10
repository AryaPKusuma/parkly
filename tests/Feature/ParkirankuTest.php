<?php

use App\Models\User;
use App\Models\ParkingLots;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\{actingAs};

it('has parkiranku page', function () {

    $response = $this->post('/authenticate', [
        'email' => 'aryakusuma0703@gmail.com',
        'password' => 'arya123',
    ]);

    $response->assertRedirect('/home');
    $user = User::where('email', 'aryakusuma0703@gmail.com')->first();

    $this->actingAs($user)->get('/parkiranku')
        ->assertStatus(200);
});

it('user can add new parkinglot', function () {
    $response = $this->post('/authenticate', [
        'email' => 'aryakusuma0703@gmail.com',
        'password' => 'arya123',
    ]);

    $response->assertRedirect('/home');
    $user = User::where('email', 'aryakusuma0703@gmail.com')->first();

    Storage::fake('public');
    $file = UploadedFile::fake()->image('parking.jpg');

    $response = $this->actingAs($user)->post('/registrasi/store', [
        'parking_name' => 'Parking Lot 1',
        'capacity' => 50,
        'address' => '123 Example St',
        'cost' => 10000,
        'photo' => $file,
        'status' => 0,
        'jam_buka' => '08:00:00',
        'jam_tutup' => '20:00:00',
        'lonlat' => '-7.175693,112.649207',
    ]);

    $response->assertRedirect('/parkiranku');
    $response->assertSessionHas('succsess', 'Parkir selesai dibuat.');

    $this->assertDatabaseHas('parkinglots', [
        'parking_name' => 'Parking Lot 1',
    ]);

});

it('user can edit parkinglot', function () {

    $parkingLot = ParkingLots::where('parking_name', 'Parking Lot 1')->first();
    $parkingLot->parking_name = 'Parking Lot 2';
    $parkingLot->save();

    $this->assertDatabaseHas('parkinglots', [
        'parking_name' => 'Parking Lot 2',
    ]);

});

it('user can delete parkinglot', function () {

    $parkingLot = ParkingLots::where('parking_name', 'Parking Lot 2')->first();
    $parkingLot->delete();

    $this->assertDatabaseMissing('parkinglots', [
        'parking_name' => 'Parking Lot 2',
    ]);

});
