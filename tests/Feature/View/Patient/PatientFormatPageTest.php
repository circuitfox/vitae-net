<?php

namespace Tests\Feature\View\Patient;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientFormatPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasPanel()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/patientformatter');
        $response->assertSee('<form class="form-horizontal">');
        $response->assertSee('<label for="mrn">MRN:</label>');
        $response->assertSee('<input type="text" id="mrn" name="mrn">');
        $response->assertSee('<label for="lname">Last Name:</label>');
        $response->assertSee('<input type="text" id="lname" name="lname">');
        $response->assertSee('<label for="fname">First Name:</label>');
        $response->assertSee('<input type="text" id="fname" name="fname">');
        $response->assertSee('<label for="dob">Date of Birth:</label>');
        $response->assertSee('<input type="text" id="dob" name="dob">');
        $response->assertSee('<label for="sex">Sex:</label>');
        $response->assertSee('<input type="text" id="sex" name="sex">');
        $response->assertSee('<label for="height">Height:</label>');
        $response->assertSee('<input type="text" id="height" name="height">');
        $response->assertSee('<label for="weight">Weight:</label>');
        $response->assertSee('<input type="text" id="weight" name="weight">');
        $response->assertSee('<label for="diagnosis">Diagnosis:</label>');
        $response->assertSee('<input type="text" id="diagnosis" name="diagnosis">');
        $response->assertSee('<label for="allergies">Allergies:</label>');
        $response->assertSee('<input type="text" id="allergies" name="allergies">');
        $response->assertSee('<label for="code">Code Status:</label>');
        $response->assertSee('<input type="text" id="code" name="code">');
        $response->assertSee('<label for="phsyician">Physician:</label>');
        $response->assertSee('<input type="text" id="physician" name="physician">');
        $response->assertSee('<label for="room">Room:</label>');
        $response->assertSee('<input type="text" id="room" name="room">');
        $response->assertSee('<button type="button" id="patient-format" class="btn btn-default">Format</button>');
        $response->assertSee('<p>Formatted code data:</p>');
        $response->assertSee('<p id="output"></p>');
    }
}
