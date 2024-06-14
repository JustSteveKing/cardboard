<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {

    }

    public function rules(): array
    {
        return [
            'uuid' => 'required|exists:products,uuid',
        ];
    }
}
