<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductFinishes;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class ProductPrice extends Model
{
    use HasFactory;
    use HasTimestamps;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'finish',
        'price',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeMostRecentForFinish($query, $productId, $finish): void
    {
        $query->where('product_id', $productId)
            ->where('finish', $finish)
            ->orderByDesc('created_at')
            ->limit(1);
    }

    /** @return array<string,string> */
    protected function casts(): array
    {
        return [
            'finish' => ProductFinishes::class,
            'price' => 'integer',
        ];
    }
}
