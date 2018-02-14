<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedFormatPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasPanel()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/medformatter');
        $response->assertSee('<div class="panel-heading">Medication Data Formatter</div>');
        $response->assertSee('<label for="primary_name" class="pull-left">Primary Name:</label>');
        $response->assertSee('<input type="text" id="primary_name" name="primary_name" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="primary_amount" class="pull-left">Primary Dosage Amount:</label>');
        $response->assertSee('<input type="text" id="primary_amount" name="primary_amount" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="primary_unit" class="pull-left">Primary Dosage Unit:</label>');
        $response->assertSee('<input type="text" id="primary_unit" name="primary_unit" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="secondary_name" class="pull-left">Secondary Name:</label>');
        $response->assertSee('<input type="text" id="secondary_name" name="secondary_name" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="second_amount" class="pull-left">Second Dosage Amount:</label>');
        $response->assertSee('<input type="text" id="second_amount" name="second_amount" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="second_unit" class="pull-left">Second Dosage Unit:</label>');
        $response->assertSee('<input type="text" id="second_unit" name="second_unit" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="second_type" class="pull-left">Second Type:</label>');
        $response->assertSee('<input type="text" id="second_type" name="second_type" class="pull-right" /><br /><br />');
        $response->assertSee('<label for="comments" class="pull-left">Comments:</label>');
        $response->assertSee('<input type="text" id="comments" name="comments" class="pull-right" />');
        $response->assertSee('<button type="button" id="med-format" class="pull-right">Format</button>');
        $response->assertSee('<p class="pull-right">Formatted code data:</p>');
        $response->assertSee('<p id="output" class="pull-right"></p>');
    }
}
