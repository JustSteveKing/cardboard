<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\Auth\AuthenticationFailure;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Responses\API\V1\TokenResponse;
use App\Services\IdentityService;
use Symfony\Component\HttpFoundation\Response;

final readonly class LoginController
{
    public function __construct(
        private IdentityService $identityService
    ) {
    }

    public function __invoke(LoginRequest $request)
    {
        if (! $this->identityService->login($request->payload())) {
            throw new AuthenticationFailure(
                message: 'Invalid Credentials',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        $token = $this->identityService->createToken('CARDBOARD_TOKEN');

        return new TokenResponse($token);
    }
}
