<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function create(Suggestion $suggestion, Request $request)
    {
        return view('comments.create', compact('suggestion'));
    }
    public function store(Suggestion $suggestion, Request $request)
    {
        $request->validate([
            'body' => ['required', 'string'],
        ]);

        $suggestion->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return to_route('suggestions.show', ['suggestion' => $suggestion])->with('success', 'Comment added successfully.');
    }

    public function edit(Comment $comment, Request $request)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Comment $comment, Request $request)
    {
        $request->validate([
            'body' => ['required', 'string'],
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return to_route('suggestions.show', ['suggestion' => $comment->suggestion])->with('success', 'Comment edited successfully.');
    }

    public function destroy(Comment $comment, Request $request)
    {
        $comment->delete();

        return to_route('suggestions.show', ['suggestion' => $comment->suggestion])->with('success', 'Comment deleted successfully.');
    }
}
