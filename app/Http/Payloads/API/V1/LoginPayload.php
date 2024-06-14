<?php

namespace App\Http\Payloads\API\V1;

final readonly class LoginPayload
{
    public function __construct(
        private string $email,
        private string $password,
    ) {
    }

    public static function make(array $data): LoginPayload
    {
        return new LoginPayload(
            email: $data['email'],
            password: $data['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
