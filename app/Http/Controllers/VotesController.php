<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    public function update(Request $request, Suggestion $suggestion)
    {
        $vote = $suggestion->votes()->where('user_id', Auth::id())->first();

        if ($vote) {
            $vote->delete();
        } else {
            $suggestion->votes()->create([
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->back();
    }
}
