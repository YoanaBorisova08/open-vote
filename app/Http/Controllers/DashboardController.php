<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function forum()
    {
        $sortQueries = [
            'newest' => ['created_at', 'desc'],
            'oldest' => ['created_at', 'asc'],
            'most_voted' => ['votes_count', 'desc'],
            'least_voted' => ['votes_count', 'asc'],
        ];

        $sort = request()->query('sort') ?? 'newest';
        $status = request()->query('status');

        $suggestions = Suggestion::getWithVotesQuery()
            ->orderBy($sortQueries[$sort][0], $sortQueries[$sort][1])
            ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->paginate(6);

        return view('suggestions.forum', [
            'suggestions' => $suggestions,
            'sort' => $sort,
            'status' => $status,
        ]);
    }

    public function myVotes()
    {
        $suggestions = Suggestion::getWithVotesQuery()
            ->whereHas('votes', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('votes_count', 'desc')
            ->paginate(6);

        return view('suggestions.votes', [
            'suggestions' => $suggestions,
        ]);
    }

    public function profile()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }
}
