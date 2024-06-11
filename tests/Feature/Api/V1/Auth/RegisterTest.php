<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can register a user', function () {

    $name = fake()->name;

    $email = fake()->email;

    $response = $this->post(route('v1.register'), [
        'name' => $name,
        'email' => $email,
        'password' => 'password',
        'token_name' => 'test',
    ]);

    $response->assertStatus(201);

    $this->assertDatabaseHas('users', [
        'name' => $name,
        'email' => $email,
    ]);
});
