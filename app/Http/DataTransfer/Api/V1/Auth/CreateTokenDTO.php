<?php

namespace App\Http\DataTransfer\Api\V1\Auth;

use App\Http\DataTransfer\BaseDTO;

class CreateTokenDTO extends BaseDTO
{
    public function __construct(
        public string $token,
        public string $tokenType,
    ) {
    }
}
