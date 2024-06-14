<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class ProductRelease extends Model
{
    use HasFactory;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'code',
        'external_id',
    ];

    /** @return HasMany<Product> */
    public function products(): HasMany
    {
        return $this->hasMany(
            related: Product::class,
            foreignKey: 'product_release_id',
        );
    }
}
