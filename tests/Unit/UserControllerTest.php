<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/users');
        $response->assertViewIs('admin.users');
    }

    public function testCreate()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->get('/users/create');
        $response->assertViewIs('admin.users.create');
    }

    public function testCreateAdminOnly()
    {
        $user = factory(User::class)->states('student')->create();
        $this->assertFalse($user->isAdmin());
        $response = $this->actingAs($user)->get('/users/create');
        $response->assertStatus(403);
    }

    public function testStore()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->post('/users', [
            'name' => 'jsmith',
            'email' => 'jsmith@example.com',
            'role' => 'instructor',
        ]);
        $response->assertRedirect();
        $user = User::where([
            'name' => 'jsmith',
            'email' => 'jsmith@example.com',
            'role' => 'instructor',
        ])->first();
        $this->assertEquals($user->name, 'jsmith');
        $this->assertEquals($user->email, 'jsmith@example.com');
        $this->assertEquals($user->role, 'instructor');
        $this->assertTrue(Hash::check(config('auth.default_password'), $user->password));
        $this->assertEquals($user->reset_password, 1);
    }

    public function testStoreAdminOnly()
    {
        $user = factory(User::class)->states('student')->create();
        $this->assertFalse($user->isAdmin());
        $response = $this->actingAs($user)->post('/users', [
            'name' => 'jsmith',
            'email' => 'jsmith@example.com',
            'role' => 'instructor',
        ]);
        $response->assertStatus(403);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/users/' . $user->id);
        $response->assertViewIs('admin.user');
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/users/' . $user->id . '/edit');
        $response->assertViewIs('admin.user.edit');
    }

    public function testEditSelfOnly()
    {
        $user = factory(User::class)->create();
        $user1 = factory(User::class)->create();
        $response = $this->actingAs($user1)->get('/users/' . $user->id . '/edit');
        $response->assertStatus(403);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->put('/users/' . $user->id, [
            'old_password' => config('auth.default_password'),
            'password' => 'testpass',
            'password_confirmation' => 'testpass',
        ]);
        $response->assertRedirect('/users/' . $user->id);
        $user1 = User::find($user->id);
        $this->assertEquals($user->name, $user1->name);
        $this->assertEquals($user->email, $user1->email);
        $this->assertNotEquals($user->password, $user1->password);
        $this->assertEquals($user->role, $user1->role);
    }

    public function testUpdateSelfOnly()
    {
        $user = factory(User::class)->create();
        $user1 = factory(User::class)->create();
        $response = $this->actingAs($user)->put('/users/' . $user1->id, [
            'old_password' => config('auth.default_password'),
            'password' => 'testpass',
            'password_confirmation' => 'testpass',
        ]);
        $response->assertStatus(403);
    }

    public function testUpdateNullField()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->put('/users/' . $user->id, [
            'email' => null,
            'old_password' => config('auth.default_password'),
            'password' => 'testpass',
            'password_confirmation' => 'testpass',
        ]);
        $response->assertRedirect('/users/' . $user->id);
        $user1 = User::find($user->id);
        $this->assertEquals($user->name, $user1->name);
        $this->assertEquals($user->email, $user1->email);
        $this->assertNotEquals($user->password, $user1->password);
        $this->assertEquals($user->role, $user1->role);
    }

    public function testDelete()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->delete('/users/' . $user->id);
        $response->assertRedirect();
        $this->assertNull(User::find($user->id));
    }

    public function testDeleteAdminOrSelf()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->states('student')->create();
        $user1 = factory(User::class)->states('instructor')->create();

        $response = $this->actingAs($user)->delete('/users/' . $user->id);
        $response->assertRedirect();
        $this->assertNull(User::find($user->id));

        $response = $this->actingAs($user1)->delete('/users/' . $admin->id);
        $response->assertStatus(403);
        $this->assertNotNull(User::find($admin->id));

        $response = $this->actingAs($admin)->delete('/users/' . $user1->id);
        $response->assertRedirect();
        $this->assertNull(User::find($user1->id));
    }
}
