<?php

use App\Models\User;

test('it logs out a user', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'example@email.com',
        'password' => 'password',
    ]);

    $this->actingAs($user);

    $this->visit('/suggestions')
        ->click('Log out')
        ->assertPathIs('/suggestions');

    $this->assertGuest();
});

