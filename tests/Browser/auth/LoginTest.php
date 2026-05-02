<?php

use App\Models\User;

test('it logs in a user', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'example@email.com',
        'password' => 'password',
    ]);

    $this->visit('/login')
        ->assertSee('Sign in to your account to continue voting')
        ->fill('email', $user->email)
        ->fill('password', 'password')
        ->click('@log-in-button')
        ->assertPathIs('/suggestions');

    $this->assertAuthenticatedAs($user);

});

test('it attempts to log in a user with wrong credentials', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'example@email.com',
        'password' => 'password',
    ]);

    $this->visit('/login')
        ->assertSee('Sign in to your account to continue voting')
        ->fill('email', $user->email)
        ->fill('password', 'wrongPassword')
        ->click('@log-in-button')
        ->assertPathIs('/login')
        ->assertSee('The provided credentials do not match our records.');

    $this->assertGuest();

});

test('already logged in user attempts to log in', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'example@email.com',
        'password' => 'password',
    ]);

    $this->actingAs($user);

    $this->visit('/login')
        ->assertPathIs('/suggestions');

    $this->assertAuthenticated();

});

test('it redirects to home page when cancel is clicked on the login page', function () {
    $page = visit('/login');

    $page->click('Cancel')
        ->assertPathIs('/suggestions');
});

test('it redirects to register page when create one is clicked on the login page', function () {
    $page = visit('/login');

    $page->click('Create one')
        ->assertPathIs('/register');
});

