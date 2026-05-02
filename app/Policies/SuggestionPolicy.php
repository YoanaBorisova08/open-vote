<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Suggestion;
use App\Models\User;

class SuggestionPolicy
{
    public function modify(User $user, Suggestion $suggestion): bool
    {
        if ($suggestion->user()->is($user)) {
            return true;
        }

        return $user->can('admin');
    }
}
