<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientEditPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasForm()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number . '/edit');
        $response->assertSee('<input id="first-name" class="form-control" type="text" name="first_name" value="' . $patient->first_name . '" required>');
        $response->assertSee('<input id="last-name" class="form-control" type="text" name="last_name" value="' . $patient->last_name . '" required>');
        $response->assertSee('<input id="dob" class="form-control" type="text" name="date_of_birth" value="' . $patient->date_of_birth . '" required>');
        $response->assertSee('<select id="sex" class="form-control" name="sex" form="patient-edit-form" value="' . ($patient->sex ? '1' : '0') . '">');
        $response->assertSee('<input id="height" class="form-control" type="text" name="height" value="' . $patient->height . '" required>');
        $response->assertSee('<input id="weight" class="form-control" type="text" name="weight" value="' . $patient->weight . '" required>');
        $response->assertSee('<input id="diagnosis" class="form-control" type="text" name="diagnosis" value="' . $patient->diagnosis . '" required>');
        $response->assertSee('<input id="allergies" class="form-control" type="text" name="allergies" value="' . $patient->allergies . '" required>');
        $response->assertSee('<input id="code_status" class="form-control" type="text" name="code_status" value="' . $patient->code_status . '" required>');
        $response->assertSee('<input id="physician" class="form-control" type="text" name="physician" value="' . $patient->physician . '" required>');
        $response->assertSee('<input class="form-control" type="text" name="room" value="' . $patient->room . '" required>');
        $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
        $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
    }
}
