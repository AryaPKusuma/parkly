<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use function Pest\Laravel\{get};
use function Pest\Laravel\{post};
use function Pest\Laravel\{withSession};

it('has login page', function () {
    get('/')->assertStatus(200);
});

it('user can login and redirect to homepage', function () {
    $response = $this->post('/authenticate', [
        'email' => 'aryakusuma0703@gmail.com',
        'password' => 'arya123',
    ]);

    $response->assertStatus(302);
    $response->assertRedirect('/home');
    $response->assertSessionHas('success', 'Registrasi berhasil!');

});

