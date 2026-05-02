<?php

use App\Models\User;

test('it deletes a user profile', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'example@email.com',
        'password' => 'password',
    ]);

    $this->actingAs($user);

    $this->visit('/profile')
        ->assertSee('My Profile')
        ->click('Delete Account')
        ->assertPathIs('/suggestions');

    $this->assertDatabaseEmpty('users');
    $this->assertGuest();
});
