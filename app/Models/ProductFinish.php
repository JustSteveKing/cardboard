<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductFinishes;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class ProductFinish extends Model
{
    use HasFactory;
    use HasTimestamps;
    use SoftDeletes;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'slug',
    ];

    /** @return array<string,class-string> */
    protected function casts(): array
    {
        return [
            'slug' => ProductFinishes::class,
        ];
    }
}
