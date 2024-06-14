<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

final class ProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Product::class);
    }

    public function rules(): array
    {
        return [
            'uuids' => 'nullable|string|max:1000',
        ];
    }
}
