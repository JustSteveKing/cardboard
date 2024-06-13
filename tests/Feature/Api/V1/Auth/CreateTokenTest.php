<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a token', function () {

    $user = User::factory()->create();

    $response = $this->post(route('v1.token.create'), [
        'email' => $user->email,
        'password' => 'password',
        'token_name' => 'test',
    ], ['Accepts' => 'application/json']);

    $response->assertStatus(201);

});
