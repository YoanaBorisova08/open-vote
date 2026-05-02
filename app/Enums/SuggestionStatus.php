<?php

declare(strict_types=1);

namespace App\Enums;

enum SuggestionStatus: string
{
    case NEW = 'new';
    case APPROVED = 'approved';
    case IN_PROGRESS = 'in progress';
    case COMPLETED = 'completed';
    case REJECTED = 'rejected';
}
