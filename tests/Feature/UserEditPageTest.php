<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEditPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasUser()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/users/' . $user->id . '/edit');
        $response->assertSee('<h3>Edit User Account ' . $user->email . '</h3>');
        $response->assertSee('<form class="form-horizontal" method="POST" action="/users/' . $user->id . '">');
        $response->assertSee('<label for="name" class="col-md-2 control-label">Name:</label>');
        $response->assertSee('<input type="hidden" class="form-control" id="name" name="name" required value="' . $this->faker_escape($user->name) . '">');
        $response->assertSee('<input type="text" class="form-control" id="_name" name="_name" disabled value="' . $this->faker_escape($user->name) . '">');
        $response->assertSee('<label for="email" class="col-md-2 control-label">Email Address:</label>');
        $response->assertSee('<input type="text" class="form-control" id="email" name="email" required value="' . $user->email . '">');
        $response->assertSee('<label for="role" class="col-md-2 control-label">Role:</label>');
        $response->assertSee('<input type="hidden" class="form-control" id="role" name="role" required value="' . $user->role . '">');
        $response->assertSee('<input type="text" class="form-control" id="_role" name="_role" disabled value="' . $user->role . '">');
        $response->assertSee('<input id="old_password" type="password" class="form-control" name="old_password">');
        $response->assertSee('<label for="password" class="col-md-2 control-label">Password</label>');
        $response->assertSee('<input id="password" type="password" class="form-control" name="password">');
        $response->assertSee('<label for="password_confirmation" class="col-md-2 control-label">Confirm Password:</label>');
        $response->assertSee('<input id="password_confirmation" type="password" class="form-control" name="password_confirmation">');
        $response->assertSee('<a class="btn btn-default" href="http://localhost">Cancel</a>');
        $response->assertSee('<button type="submit" class="btn btn-primary">Update</button>');
    }
}
