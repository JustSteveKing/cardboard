<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{
    use HasFactory,HasTimestamps,SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_finish_id',
        'price',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productFinish(): BelongsTo
    {
        return $this->belongsTo(ProductFinish::class);
    }

    public function scopeMostRecentForFinish($query, $productId, $finishId)
    {
        $query->where('product_id', $productId)
            ->where('product_finish_id', $finishId)
            ->orderByDesc('created_at')
            ->limit(1);
    }
}
