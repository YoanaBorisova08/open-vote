<?php

namespace App\Policies;

use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SuggestionPolicy
{
    public function modify(User $user, Suggestion $suggestion): bool
    {
        return $suggestion->user()->is($user);
    }

}
