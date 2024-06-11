<?php

namespace App\Http\DataTransfer\Api\V1\Auth;

use App\Http\DataTransfer\BaseDTO;

class RegisterDTO extends BaseDTO
{
    public function __construct(
        public string $message,
        public int $userId,
        public string $token,
        public string $tokenName,
        public string $tokenType,
    ) {
    }
}
