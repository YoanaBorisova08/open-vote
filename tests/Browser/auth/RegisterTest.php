<?php

use App\Models\User;

test('it registers a user', function () {
    $this->visit('/register')
        ->assertSee('Create your account')
        ->fill('name', 'John Doe')
        ->fill('email', 'johndoe@email.com')
        ->fill('password', 'password')
        ->click('@create-account-button')
        ->assertPathIs('/suggestions');

    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', [
        'name'  => 'John Doe',
        'email' => 'johndoe@email.com',
    ]);
});

test('it attempts to register a user with invalid password', function () {
    $this->visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'johndoe@email.com')
        ->fill('password', 'pass')
        ->click('@create-account-button')
        ->assertPathIs('/register')
        ->assertSee('The password field must be at least 5 characters.');

    $this->assertGuest();

});

test('already logged in user attempts to register', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'example@email.com',
        'password' => 'password',
    ]);

    $this->actingAs($user);

    $this->visit('/register')
        ->assertPathIs('/suggestions');

    $this->assertAuthenticated();

});


test('it redirects to home page when cancel is clicked on the register page', function () {
    $page = visit('/register');

    $page->click('Cancel')
        ->assertPathIs('/suggestions');
});

test('it redirects to log in page when sign in is clicked on the register page', function () {
    $page = visit('/register');

    $page->click('Sign in')
        ->assertPathIs('/login');
});

