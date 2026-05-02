<?php

use App\Models\Suggestion;
use App\Models\User;

test('guest opens forum', function () {
    $user = User::factory()->create();

    $first  = Suggestion::factory()->create([
        'title'      => 'First Suggestion',
        'created_at' => now()->subDays(2),
        'user_id'    => $user->id,
    ]);
    $second = Suggestion::factory()->create([
        'title'      => 'Second Suggestion',
        'created_at' => now()->subDays(1),
        'user_id'    => $user->id,
    ]);
    $third  = Suggestion::factory()->create([
        'title'      => 'Third Suggestion',
        'created_at' => now(),
        'user_id'    => $user->id,
    ]);


    $page = $this->visit('/forum')->assertSee('Vote. Suggest. Influence.');

    $page->assertSeeInOrder([
        'Third Suggestion',
        'Second Suggestion',
        'First Suggestion',
    ]);
});
