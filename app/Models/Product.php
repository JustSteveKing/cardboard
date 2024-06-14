<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductFranchises;
use App\Enums\ProductProviders;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

final class Product extends Model
{
    use HasFactory;
    use HasTimestamps;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'uuid',
        'description',
        'external_id',
        'image_path',
        'category',
        'franchise',
        'provider',
        'product_release_id',
    ];

    /** @return BelongsTo<ProductRelease> */
    public function release(): BelongsTo
    {
        return $this->belongsTo(
            related: ProductRelease::class,
            foreignKey: 'product_release_id',
        );
    }

    /** @return HasMany<ProductPrice> */
    public function prices(): HasMany
    {
        return $this->hasMany(
            related: ProductPrice::class,
            foreignKey: 'product_id',
        );
    }

    protected static function booted(): void
    {
        self::created(static function (Product $product): void {
            $product->update([
                'uuid' => Str::uuid(),
            ]);
        });
    }

    /** @return array<string,class-string> */
    protected function casts(): array
    {
        return [
            'provider' => ProductProviders::class,
            'franchise' => ProductFranchises::class,
        ];
    }
}
