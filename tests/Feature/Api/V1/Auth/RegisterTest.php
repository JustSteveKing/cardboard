<?php

use Illuminate\Foundation\Testing\RefreshDatabase;


it('can register a user', function () {

    $email = fake()->email;

    $response = $this->post(route('v1.register'), [
        'email' => $email,
        'password' => 'password',
    ], ['Accepts' => 'application/json']);

    $response->assertStatus(200);

    $this->assertDatabaseHas('users', [
        'email' => $email,
    ]);
});
