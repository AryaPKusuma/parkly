<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;


it('has register page', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

it('user can create ccount', function () {

        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'notelp' => '081234567890'
        ];

        $response = $this->post(route('user.register'), $data);
        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Registrasi berhasil!');

        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'name' => 'Test User'
        ]);

        $user = User::where('email', 'testuser@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));

        $user->delete();
    });

it('fails registration with invalid data', function () {

        $data = [
            'name' => '',
            'email' => 'not-an-email',
            'password' => '123',
            'notelp' => 'not-a-phone-number'
        ];

        $response = $this->post(route('user.register'), $data);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['name', 'email', 'password', 'notelp']);
});
