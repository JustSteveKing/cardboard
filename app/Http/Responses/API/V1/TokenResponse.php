<?php

namespace App\Http\Responses\API\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\NewAccessToken;

final readonly class TokenResponse implements Responsable
{
    public function __construct(
        private NewAccessToken $token,
    ) {
    }

    public function toResponse($request)
    {
        return new JsonResponse(
            data: [
                'token' => $this->token->plainTextToken,
            ],
        );
    }
}
