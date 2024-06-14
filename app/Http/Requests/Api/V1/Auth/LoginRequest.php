<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Payloads\API\V1\LoginPayload;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'name' => 'nullable|string|max:50',
            'password' => 'required|string',
        ];
    }

    public function payload(): LoginPayload
    {
        return LoginPayload::make($this->all());
    }
}
