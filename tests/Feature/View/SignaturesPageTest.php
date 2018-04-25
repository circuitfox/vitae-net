<?php

namespace Tests\Feature\View;

use App\Signature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignaturesPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasTable()
    {
        $admin = factory(\App\User::class)->states('admin')->create();
        $signatures = factory(Signature::class, 2)->create();
        $response = $this->actingAs($admin)->get('/signatures');
        $response->assertSee('<th>Name</th>');
        $response->assertSee('<th>Patient</th>');
        $response->assertSee('<th>Medication</th>');
        $response->assertSee('<th>Comments</th>');
        $response->assertSee('<th>Time</th>');
        $response->assertSee('<th>Delete</th>');
        $response->assertSee('<td>' . $this->faker_escape($signatures[0]->student_name) . '</td>');
        $response->assertSee('<td>' . $this->faker_escape($signatures[0]->patient->first_name . ' ' . $signatures[0]->patient->last_name) . '</td>');
        $response->assertSee('<td>' . $signatures[0]->medication->toString() . '</td>');
        $response->assertSee('<td>' . $signatures[0]->comments . '</td>');
        $response->assertSee('<td>' . $signatures[0]->time . '</td>');
        $response->assertSee('<td><input type="checkbox" name="ids[' . $signatures[0]->id . ']" value="' . $signatures[0]->id . '"></td>');
        $response->assertSee('<td>' . $this->faker_escape($signatures[1]->student_name) . '</td>');
        $response->assertSee('<td>' . $this->faker_escape($signatures[1]->patient->first_name . ' ' . $signatures[1]->patient->last_name) . '</td>');
        $response->assertSee('<td>' . $signatures[1]->comments . '</td>');
        $response->assertSee('<td>' . $signatures[1]->medication->toString() . '</td>');
        $response->assertSee('<td>' . $signatures[1]->time . '</td>');
        $response->assertSee('<td><input type="checkbox" name="ids[' . $signatures[1]->id . ']" value="' . $signatures[1]->id . '"></td>');
        $response->assertSee('<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#signatures-delete-modal">Delete</button>');
    }

    public function testIfEmpty()
    {
        $admin = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->get('/signatures');
        $response->assertSee('<h3 class="text-center">No signatures in the database.</h3>');
    }

    public function testHasModal()
    {
        $admin = factory(\App\User::class)->states('admin')->create();
        $signatures = factory(Signature::class, 2)->create();
        $response = $this->actingAs($admin)->get('/signatures');
        $response->assertSee('<div class="modal fade" id="signatures-delete-modal" tabindex=-1 role="dialog">');
        $response->assertSee('<button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>');
        $response->assertSee('<h4 class="modal-title">Delete Signature(s)</h4>');
        $response->assertSee('<p>Are you sure you want to delete these signature(s)?</p>');
        $response->assertSee('<button type="button" class="btn btn-default col-md-offset-7 col-md-2" data-dismiss="modal">No</button>');
        $response->assertSee('<button type="submit" class="btn btn-danger col-md-2">Yes</button>');
    }
}
