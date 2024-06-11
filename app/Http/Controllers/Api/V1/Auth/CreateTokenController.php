<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\DataTransfer\Api\V1\Auth\CreateTokenDTO;
use App\Http\Requests\Api\V1\Auth\CreateTokenRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class CreateTokenController extends Controller
{
    public function __invoke(CreateTokenRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        // @phpstan-ignore-next-line
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $createTokenDto = new CreateTokenDTO(
            token: $token,
            tokenType: 'Bearer'
        );

        return response()->json($createTokenDto->toArray());
    }
}
