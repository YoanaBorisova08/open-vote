<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function forum()
    {
        $sort_queries = [
            'newest' => ['created_at', 'desc'],
            'oldest' => ['created_at', 'asc'],
            'most_voted' => ['votes_count', 'desc'],
            'least_voted' => ['votes_count', 'asc'],
        ];

        $sort = request()->query('sort') ?? 'newest';
        $status = request()->query('status');

        $suggestions = Suggestion::get_with_votes_query()
            ->orderBy($sort_queries[$sort][0], $sort_queries[$sort][1])
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->paginate(6);

        return view('suggestions.forum', compact([
            'suggestions',
            'sort',
            'status',
        ]));
    }

    public function my_votes()
    {
        $suggestions = Suggestion::get_with_votes_query()
            ->whereHas('votes', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('votes_count', 'desc')
            ->paginate(6);

        return view('suggestions.votes', compact([
            'suggestions',
        ]));
    }

    public function profile()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }
}
