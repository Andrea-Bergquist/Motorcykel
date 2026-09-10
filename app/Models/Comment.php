<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['user_id', 'guest_name', 'body'];

    // Koppling till användare (om inloggad)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
