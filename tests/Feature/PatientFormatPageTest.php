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
        $response->assertSee('<label for="mrn" class="pull-left">MRN:</label>');
        $response->assertSee('<input type="text" id="mrn" name="mrn" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="lname" class="pull-left">Last Name:</label>');
        $response->assertSee('<input type="text" id="lname" name="lname" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="fname" class="pull-left">First Name:</label>');
        $response->assertSee('<input type="text" id="fname" name="fname" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="dob" class="pull-left">Date of Birth:</label>');
        $response->assertSee('<input type="text" id="dob" name="dob" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="sex" class="pull-left">Sex:</label>');
        $response->assertSee('<input type="text" id="sex" name="sex" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="height" class="pull-left">Height:</label>');
        $response->assertSee('<input type="text" id="height" name="height" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="weight" class="pull-left">Weight:</label>');
        $response->assertSee('<input type="text" id="weight" name="weight" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="diagnosis" class="pull-left">Diagnosis:</label>');
        $response->assertSee('<input type="text" id="diagnosis" name="diagnosis" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="allergies" class="pull-left">Allergies:</label>');
        $response->assertSee('<input type="text" id="allergies" name="allergies" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="code" class="pull-left">Code Status:</label>');
        $response->assertSee('<input type="text" id="code" name="code" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="phsyician" class="pull-left">Physician:</label>');
        $response->assertSee('<input type="text" id="physician" name="physician" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="room" class="pull-left">Room:</label>');
        $response->assertSee('<input type="text" id="room" name="room" class="pull-right" />');
        $response->assertSee('<button type="button" id="format" class="pull-right">Format</button>');
        $response->assertSee('<p class="pull-right">Formatted code data:</p>');
        $response->assertSee('<p id="output" class="pull-right"></p>');
    }
}
