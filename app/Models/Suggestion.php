<?php

namespace App\Models;

use App\Enums\SuggestionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Suggestion extends Model
{
    /** @use HasFactory<\Database\Factories\SuggestionFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'user_id', 'body'];

    protected array $colors = [
    SuggestionStatus::NEW->value         => 'bg-blue-50 text-blue-800',
    SuggestionStatus::COMPLETED->value   => 'bg-teal-50 text-teal-800',
    SuggestionStatus::IN_PROGRESS->value => 'bg-amber-50 text-amber-800',
    SuggestionStatus::APPROVED->value    => 'bg-violet-50 text-violet-800',
    SuggestionStatus::REJECTED->value    => 'bg-red-50 text-red-800',
    ];

    protected $casts = [
        'status' => SuggestionStatus::class
    ];

    protected $attributes = [
        'status' => SuggestionStatus::NEW->value,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function comments(): HasMany{
        return $this->hasMany(Comment::class);
    }

    public function color()
    {
        return $this->colors[$this->status->value];
    }

    public static function get_with_votes_query(): \Illuminate\Database\Eloquent\Builder
    {
        return Suggestion::with(['user', 'votes'])
            ->withCount('votes');
    }
}
