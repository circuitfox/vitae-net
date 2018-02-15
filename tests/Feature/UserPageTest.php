<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPageTest extends TestCase
{
    use RefreshDatabase;
    
    public function testHasUser()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/users/' . $user->id);
        $response->assertSee('<h3>' . $user->email . '</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $this->faker_escape($user->name) . '</p>');
        $response->assertSee('<h5><b><u>Email:</u></b></h5>');
        $response->assertSee('<p>' . $user->email. '</p>');
        $response->assertSee('<h5><b><u>Role:</u></b></h5>');
        $response->assertSee('<p>' . $user->role . '</p>');
    }
}
