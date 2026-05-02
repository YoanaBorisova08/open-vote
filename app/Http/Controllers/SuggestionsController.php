<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search');
        $search_suggestions = $search ? Suggestion::getWithVotesQuery()
            ->where('title', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(6) : null;

        $popular_suggestions = Suggestion::getWithVotesQuery()
            ->orderBy('votes_count', 'desc')
            ->limit(3)
            ->get();

        $recent_suggestions = Suggestion::getWithVotesQuery()
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('suggestions.index', [
            'search' => $search,
            'search_suggestions' => $search_suggestions,
            'popular_suggestions' => $popular_suggestions,
            'recent_suggestions' => $recent_suggestions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suggestions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $suggestion = Auth::user()->suggestions()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return to_route('suggestions.show', ['suggestion' => $suggestion])->with('success', 'Suggestion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Suggestion $suggestion)
    {
        return view('suggestions.show', [
            'suggestion' => $suggestion->load('votes', 'user', 'comments')->loadCount('votes'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suggestion $suggestion)
    {
        return view('suggestions.edit', [
            'suggestion' => $suggestion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suggestion $suggestion)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $suggestion->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return to_route('suggestions.show', ['suggestion' => $suggestion])->with('success', 'Suggestion updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suggestion $suggestion)
    {
        $suggestion->delete();

        return to_route('suggestions.index')->with('success', 'Suggestion deleted successfully.');
    }
}
