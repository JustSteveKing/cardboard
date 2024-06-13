<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory,HasTimestamps,SoftDeletes;

    protected $fillable = [
        'name',
        'uuid',
        'description',
        'product_provider_external_id',
        'image_path',
        'product_category_id',
        'product_franchise_id',
        'product_provider_id',
        'product_release_id',
    ];

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productFranchise(): BelongsTo
    {
        return $this->belongsTo(ProductFranchise::class);
    }

    public function productProvider(): BelongsTo
    {
        return $this->belongsTo(ProductProvider::class);
    }

    public function productRelease(): BelongsTo
    {
        return $this->belongsTo(ProductRelease::class);
    }

    public function productPrices(): HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }

    protected static function booted(): void
    {
        static::created(function (Product $product) {
            $product->update([
                'uuid' => Str::uuid(),
            ]);
        });
    }
}
