<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientsPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasPatient()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($user)->get('/patients');
        $response->assertSee('<h3>'
            . $this->faker_escape($patient->first_name . ' ' . $patient->last_name)
            . '</h3>');
        $response->assertSee('<a class="btn btn-default h3" href="' . route('patients.show', ['id' => $patient->medical_record_number]) . '">Details</a>');
        $response->assertSee('<a class="btn btn-primary h3" href="' . route('patients.edit', ['id' => $patient->medical_record_number]) . '">Edit</a>');
        $response->assertSee('<button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#patient-delete-modal" data-id="' . $patient->medical_record_number . '">Delete</button>');
        $response->assertSee('<h3>' . $this->faker_escape($patient->first_name . ' ' . $patient->last_name) . '</h3>');
        $response->assertSee('<h5><b><u>First Name:</u></b></h5>');
        $response->assertSee('<p>' . $this->faker_escape($patient->first_name) . '</p>');
        $response->assertSee('<h5><b><u>Last Name:</u></b></h5>');
        $response->assertSee('<p>' . $this->faker_escape($patient->last_name) . '</p>');
        $response->assertSee('<h5><b><u>Date Of Birth:</u></b></h5>');
        $response->assertSee('<p>' . $patient->date_of_birth . '</p>');
        $response->assertSee('<h5><b><u>Sex:</u></b></h5>');
        $response->assertSee('<p>' . ($patient->sex ? 'Male' : 'Female') . '</p>');
        $response->assertSee('<h5><b><u>Height:</u></b></h5>');
        $response->assertSee('<p>' . $patient->height . '</p>');
        $response->assertSee('<h5><b><u>Weight:</u></b></h5>');
        $response->assertSee('<p>' . $patient->weight . '</p>');
        $response->assertSee('<h5><b><u>Diagnosis:</u></b></h5>');
        $response->assertSee('<p>' . $patient->diagnosis . '</p>');
        $response->assertSee('<h5><b><u>Allergies:</u></b></h5>');
        $response->assertSee('<p>' . $patient->allergies . '</p>');
        $response->assertSee('<h5><b><u>Code Status:</u></b></h5>');
        $response->assertSee('<p>' . $patient->code_status . '</p>');
        $response->assertSee('<h5><b><u>Physician:</u></b></h5>');
        $response->assertSee('<p>' . $this->faker_escape($patient->physician) . '</p>');
        $response->assertSee('<h5><b><u>Room:</u></b></h5>');
        $response->assertSee('<p>' . $patient->room . '</p>');
    }

    public function testHasModal()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/patients');
        $response->assertSee('<button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>');
        $response->assertSee('<h4 class="modal-title">Delete Patient</h4>');
        $response->assertSee('<p>Are you sure you want to delete this patient?</p>');
        $response->assertSee('<button type="button" class="btn btn-default col-md-offset-8 col-md-2" data-dismiss="modal">No</button>');
        $response->assertSee('<form name="delete-patient" action="" method="post" id="delete-patient">');
        $response->assertSee('<button type="submit" class="btn btn-danger col-md-2">Yes</button>');
    }
}
