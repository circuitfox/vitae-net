<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasEntries()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $marEntry = factory(\App\MarEntry::class)->create();
        $meds = [$marEntry->Medication->toMarArray()];
        $complete = session('complete.' . $marEntry->medical_record_number);
        if ($complete === null) {
            $complete = [];
        }
        $response = $this->actingAs($user)->get('/mars/' . $marEntry->medical_record_number);
        $response->assertSee('Viewing MAR for '
            . $this->faker_escape($marEntry->patient->first_name . ' ' . $marEntry->patient->last_name)
            . ' (MRN: ' . $marEntry->medical_record_number . ')');
        $response->assertSee('<tr is="mar-entry"');
        $response->assertSee(':meds="' . $this->faker_escape(json_encode($meds)) . '"');
        $response->assertSee(':mar-entry="' . $this->faker_escape($marEntry->toJsonArray()) . '"');
        $response->assertSee(':is-admin="' . $this->faker_escape(json_encode($user->isAdmin())) . '"');
        $response->assertSee('route="' . route('mars.update', ['id' => $marEntry->id]) . '"');
        $response->assertSee(':complete="' . $this->faker_escape(json_encode($complete)) . '">');
    }

    public function testHasModal()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $marEntry = factory(\App\MarEntry::class)->create();
        $meds = [$marEntry->Medication->toMarArray()];
        $complete = session('complete.' . $marEntry->medical_record_number);
        if ($complete === null) {
            $complete = [];
        }
        $response = $this->actingAs($user)->get('/mars/' . $marEntry->medical_record_number);
        $response->assertSee('<button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>');
        $response->assertSee('<h4 class="modal-title">Delete MAR entry</h4>');
        $response->assertSee('<p>Are you sure you want to delete this MAR entry?</p>');
        $response->assertSee('<button type="button" class="btn btn-default col-md-offset-8 col-md-2" data-dismiss="modal">No</button>');
        $response->assertSee('<form name="delete-mar" action="" method="post" id="delete-mar">');
        $response->assertSee('<button type="submit" class="btn btn-danger col-md-2">Yes</button>');
    }
}
