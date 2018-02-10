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
        $response->assertSee('<label for="primary_name">Primary Name:</label>');
        $response->assertSee('<input type="text" id="primary_name" name="primary_name" /><br /><br />');
        $response->assertSee('<label for="primary_amount">Primary Dosage Amount:</label>');
        $response->assertSee('<input type="text" id="primary_amount" name="primary_amount" /><br /><br />');
        $response->assertSee('<label for="primary_unit">Primary Dosage Unit:</label>');
        $response->assertSee('<input type="text" id="primary_unit" name="primary_unit" /><br /><br />');
        $response->assertSee('<label for="secondary_name">Secondary Name:</label>');
        $response->assertSee('<input type="text" id="secondary_name" name="secondary_name" /><br /><br />');
        $response->assertSee('<label for="second_amount">Second Dosage Amount:</label>');
        $response->assertSee('<input type="text" id="second_amount" name="second_amount" /><br /><br />');
        $response->assertSee('<label for="second_unit">Second Dosage Unit:</label>');
        $response->assertSee('<input type="text" id="second_unit" name="second_unit" /><br /><br />');
        $response->assertSee('<label for="second_type">Second Type:</label>');
        $response->assertSee('<input type="text" id="second_type" name="second_type" /><br /><br />');
        $response->assertSee('<label for="comments">Comments:</label>');
        $response->assertSee('<input type="text" id="comments" name="comments" />');
        $response->assertSee('<button type="button" id="format" class="pull-right">Format</button>');
        $response->assertSee('<p class="pull-right">Formatted code data:</p>');
        $response->assertSee('<p id="output" class="pull-right"></p>');
    }
}
