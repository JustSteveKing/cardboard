<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('can create a token', function () {

    $user = User::factory()->create();

    $response = $this->post(route('v1.login'), [
        'email' => $user->email,
        'password' => 'password',
    ], ['Accepts' => 'application/json']);

    $response->assertStatus(200);

});
