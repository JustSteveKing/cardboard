<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Payloads\API\V1\RegisterPayload;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    public function payload(): RegisterPayload
    {
        return RegisterPayload::make($this->all());
    }
}
