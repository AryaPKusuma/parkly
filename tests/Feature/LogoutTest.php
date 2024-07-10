<?php

use App\Models\User;

it('user can logout', function () {
    $response = $this->post('/authenticate', [
        'email' => 'aryakusuma0703@gmail.com',
        'password' => 'arya123',
    ]);

    $response->assertStatus(302);
    $response->assertRedirect('/home');
    $response->assertSessionHas('success', 'Registrasi berhasil!');

    $user = User::where('email', 'aryakusuma0703@gmail.com')->first();


    $response = $this->actingAs($user)->post(route('logout'));
    $response->assertRedirect('/login');
    $this->assertGuest();

});
