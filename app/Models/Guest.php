<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Guest extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'token',
        'user',
        'status_id',
        'user-agent',
        'ip',
        'cc',
        'expiration_date',
        'ccv',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
