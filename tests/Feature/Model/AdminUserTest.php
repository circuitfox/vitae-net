<?php

namespace Tests\Feature\Model;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AdminUserTest extends TestCase
{
    use RefreshDatabase;

    public function testHasAdminUser()
    {
        $admin = User::find(1);
        $this->assertNotNull($admin);
        $this->assertEquals($admin->name, 'admin');
        $this->assertEquals($admin->email, 'admin@example.com');
        $this->assertTrue(Hash::check(config('auth.default_password'), $admin->password));
        $this->assertEquals($admin->reset_password, 1);
    }

    public function testResetPassword()
    {
        $admin = User::find(1);
        $response = $this->actingAs($admin)->get('/home');
        $response->assertRedirect();
        $response = $this->followingRedirects()->actingAs($admin)->get('/home');
        $response->assertViewIs('auth.passwords.reset');
    }
}
