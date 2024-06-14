<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Payloads\API\V1\LoginPayload;
use App\Http\Payloads\API\V1\RegisterPayload;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

final readonly class IdentityService
{
    public function __construct(
        private AuthManager $authManager,
    ) {
    }

    public function login(LoginPayload $loginPayload): bool
    {
        return $this->authManager->attempt(credentials: $loginPayload->toArray());
    }

    public function register(RegisterPayload $registerPayload): bool
    {
        $data = $registerPayload->toArray();

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($user) {
            Auth::login($user);
        }

        return filled($user);
    }

    public function createToken(string $tokenName): NewAccessToken
    {
        return $this->authManager->user()->createToken($tokenName);
    }
}
