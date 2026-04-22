<?php

namespace App\Http\Controllers;

use App\Enums\SuggestionStatus;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function updateStatus(Suggestion $suggestion, Request $request)
    {
        $request->validate([
            'status' => ['required', Rule::enum(SuggestionStatus::class)]
        ]);

        $suggestion->update([
            'status' => $request->status
        ]);

        return back();
    }
}
