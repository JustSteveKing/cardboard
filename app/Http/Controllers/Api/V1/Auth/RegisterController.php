<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\DataTransfer\Api\V1\Auth\RegisterDTO;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming registration request.
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        try {
            return $this->registerUser($request);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Register a new user.
     */
    protected function registerUser(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,

            'password' => Hash::make($request->password),
        ]);

        if (! $user) {
            throw new Exception('Could not create user');
        }

        $tokenName = $request->get('token_name', 'default-token');

        $registerDTO = new RegisterDTO(
            message: 'User registered successfully!',
            userId: $user->id,
            token: $user->createToken($tokenName)->plainTextToken,
            tokenName: $tokenName,
            tokenType: 'Bearer',
        );

        return response()->json($registerDTO->toArray(), 201);
    }

    /**
     * Handle registration exceptions.
     */
    protected function handleException(Exception $e): JsonResponse
    {
        return response()->json([
            'message' => 'We could not create your account!',
            'error' => $e->getMessage(), // Optional: Include the error message for debugging
        ], 500);
    }
}
