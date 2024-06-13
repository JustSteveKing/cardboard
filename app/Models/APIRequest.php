<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class APIRequest extends Model
{
    use HasFactory;

    protected $table = 'api_requests';

    protected $fillable = [
        'user_id',
        'path',
        'params',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
