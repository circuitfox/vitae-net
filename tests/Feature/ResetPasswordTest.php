<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function testRedirectIfResetPassword()
    {
        $user = factory(\App\User::class)->states('reset_password')->create();
        $response = $this->actingAs($user)->get('/home');
        $response->assertRedirect();
    }

    public function testNoRedirectIfFalse()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->followingRedirects()->actingAs($user)->get('/home');
        $response->assertViewIs('admin');
    }

    public function testRedirectsToResetPage()
    {
        $user = factory(\App\User::class)->states('reset_password')->create();
        $response = $this->followingRedirects()->actingAs($user)->get('/home');
        $response->assertViewIs('auth.passwords.reset');
    }

    public function testRedirectsOnce()
    {
        $user = factory(\App\User::class)->states('reset_password')->create();
        $response = $this->followingRedirects()->actingAs($user)->get('/home');
        $response->assertViewIs('auth.passwords.reset');
        $token = str_after(url()->current(), 'password/reset/');

        // update the password
        $response = $this->post('/password/reset', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        // update $user
        $user = \App\User::find($user->id);
        $response->assertRedirect();
        $this->assertTrue(!$user->reset_password);

        $response = $this->followingRedirects()->actingAs($user)->get('/home');
        $response->assertViewIs('admin');
    }
}
