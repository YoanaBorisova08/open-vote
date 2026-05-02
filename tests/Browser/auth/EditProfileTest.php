<?php

use App\Models\User;

test('it opens the edit profile form and edits the user email', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'example@email.com',
        'password' => 'password',
    ]);

    $this->actingAs($user);

    $this->visit('/profile')
        ->assertSee('My Profile')
        ->click('Edit Profile')
        ->assertPathIs('/profile/edit')
        ->assertSee('Edit your account')
        ->fill('name', $user->name)
        ->fill('email', 'new@email.com')
        ->fill('password', 'password')
        ->click('Edit account')
        ->assertPathIs('/profile');

    $this->assertDatabaseHas('users', [
        'name' => 'Test User',
        'email' => 'new@email.com'
    ]);
});

test('it opens the edit profile form and edits the user passsword', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'example@email.com',
        'password' => bcrypt('password'),
    ]);

    $this->actingAs($user);

    $this->visit('/profile')
        ->assertSee('My Profile')
        ->click('Edit Profile')
        ->assertPathIs('/profile/edit')
        ->assertSee('Edit your account')
        ->fill('name', $user->name)
        ->fill('email', 'new@email.com')
        ->fill('password', 'newpassword')
        ->click('Edit account')
        ->assertPathIs('/profile');

    $this->assertDatabaseHas('users', [
        'name'  => 'Test User',
        'email' => 'new@email.com',
    ]);

    $updatedUser = $user->fresh();

    expect(Hash::check('newpassword', $updatedUser->password))->toBeTrue();
});

test('it redirects to profile page when cancel is clicked on the edit profile page', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'example@email.com',
        'password' => 'password',
    ]);

    $this->actingAs($user);

    $page = visit('/profile/edit');

    $page->click('Cancel')
        ->assertPathIs('/profile');
});

