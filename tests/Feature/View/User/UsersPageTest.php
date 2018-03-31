<?php

namespace Tests\Feature\View\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasUser()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/users');
        $response->assertSee('<h3>' . $user->email . '</h3>');
        $response->assertSee('<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#user-delete-modal" data-id="' . $user->id . '">Delete</button>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $this->faker_escape($user->name) . '</p>');
        $response->assertSee('<h5><b><u>Email:</u></b></h5>');
        $response->assertSee('<p>' . $user->email. '</p>');
        $response->assertSee('<h5><b><u>Role:</u></b></h5>');
        $response->assertSee('<p>' . $user->role . '</p>');
    }

    public function testHasModal()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/users');
        $response->assertSee('<button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>');
        $response->assertSee('<h4 class="modal-title">Delete User</h4>');
        $response->assertSee('<p>Are you sure you want to delete this user?</p>');
        $response->assertSee('<button type="button" class="btn btn-default col-md-offset-8 col-md-2" data-dismiss="modal">No</button>');
        $response->assertSee('<form name="delete-user" action="" method="post" id="delete-user">');
        $response->assertSee('<button type="submit" class="btn btn-danger col-md-2">Yes</button>');
    }
}
