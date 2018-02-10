<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientFormatPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasPanel()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/patientformatter');
        $response->assertSee('<div class="panel-heading">Patient Data Formatter</div>');
        $response->assertSee('<label for="mrn">MRN:</label>');
        $response->assertSee('<input type="text" id="mrn" name="mrn" /><br /><br />');
        $response->assertSee('<label for="lname">Last Name:</label>');
        $response->assertSee('<input type="text" id="lname" name="lname" /><br /><br />');
        $response->assertSee('<label for="fname">First Name:</label>');
        $response->assertSee('<input type="text" id="fname" name="fname" /><br /><br />');
        $response->assertSee('<label for="dob">Date of Birth:</label>');
        $response->assertSee('<input type="text" id="dob" name="dob" /><br /><br />');
        $response->assertSee('<label for="sex">Sex:</label>');
        $response->assertSee('<input type="text" id="sex" name="sex" /><br /><br />');
        $response->assertSee('<label for="height">Height:</label>');
        $response->assertSee('<input type="text" id="height" name="height" /><br /><br />');
        $response->assertSee('<label for="weight">Weight:</label>');
        $response->assertSee('<input type="text" id="weight" name="weight" /><br /><br />');
        $response->assertSee('<label for="diagnosis">Diagnosis:</label>');
        $response->assertSee('<input type="text" id="diagnosis" name="diagnosis" /><br /><br />');
        $response->assertSee('<label for="allergies">Allergies:</label>');
        $response->assertSee('<input type="text" id="allergies" name="allergies" /><br /><br />');
        $response->assertSee('<label for="code">Code Status:</label>');
        $response->assertSee('<input type="text" id="code" name="code" /><br /><br />');
        $response->assertSee('<label for="phsyician">Physician:</label>');
        $response->assertSee('<input type="text" id="physician" name="physician" /><br /><br />');
        $response->assertSee('<label for="room">Room:</label>');
        $response->assertSee('<input type="text" id="room" name="room" />');
        $response->assertSee('<button type="button" id="format" class="pull-right">Format</button>');
        $response->assertSee('<p class="pull-right">Formatted code data:</p>');
        $response->assertSee('<p id="output" class="pull-right"></p>');
    }
}
