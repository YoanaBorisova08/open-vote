<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'suggestion_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function suggestion(): BelongsTo{
        return $this->belongsTo(Suggestion::class);
    }
}
