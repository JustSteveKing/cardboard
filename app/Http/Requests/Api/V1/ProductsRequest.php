<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuids' => 'nullable|string|max:1000',
        ];
    }
}
