<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicationsPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasMedication()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $medication = factory(\App\Medication::class)->create();
        $response = $this->actingAs($user)->get('/medications');
        $response->assertSee('<h3>' . $medication->name . '</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $medication->name . '</p>');
        $response->assertSee('<h5><b><u>Dosage:</u></b></h5>');
        $response->assertSee('<p>' . $medication->dosage_amount . ' ' . $medication->dosage_unit . '</p>');
        $response->assertSee('<h5><b><u>Instructions:</u></b></h5>');
        $response->assertSee('<p>' . $medication->instructions . '</p>');
        $response->assertSee('<h5><b><u>Comments:</u></b></h5>');
        $response->assertSee('<p>' . $medication->comments . '</p>');
        $response->assertSee('<a href="/medications/' . $medication->medication_id . '/edit" class="btn btn-primary h3">Edit</a>');
        $response->assertSee('<button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#medication-delete-modal" data-id="' . $medication->medication_id . '">Delete</button>');
    }

    public function testHasModal()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $medication = factory(\App\Medication::class)->create();
        $response = $this->actingAs($user)->get('/medications');
        $response->assertSee('<button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>');
        $response->assertSee('<h4 class="modal-title">Delete Medication</h4>');
        $response->assertSee('<p>Are you sure you want to delete this medication?</p>');
        $response->assertSee('<button type="button" class="btn btn-default col-md-offset-8 col-md-2" data-dismiss="modal">No</button>');
        $response->assertSee('<form name="delete-medication" action="" method="post" id="delete-medication">');
        $response->assertSee('<button type="submit" class="btn btn-danger col-md-2">Yes</button>');
    }

    public function testHasAddButtonIfEmpty()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/medications');
        $response->assertSee('<h3 class="col-md-offset-2 col-md-8 text-center">No medications in the database. Add some?</h3>');
        $response->assertSee('<a href="' . route('medications.create') . '" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Medications</a>');
    }
}
