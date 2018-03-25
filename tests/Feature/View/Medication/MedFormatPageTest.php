<?php

namespace Tests\Feature\View\Medication;

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
        $response->assertSee('<form class="form-horizontal">');
        $response->assertSee('<label for="primary_name">Primary Name:</label>');
        $response->assertSee('<input type="text" id="primary_name" name="primary_name">');
        $response->assertSee('<label for="primary_amount">Primary Dosage Amount:</label>');
        $response->assertSee('<input type="text" id="primary_amount" name="primary_amount">');
        $response->assertSee('<label for="primary_unit">Primary Dosage Unit:</label>');
        $response->assertSee('<input type="text" id="primary_unit" name="primary_unit">');
        $response->assertSee('<label for="secondary_name">Secondary Name:</label>');
        $response->assertSee('<input type="text" id="secondary_name" name="secondary_name">');
        $response->assertSee('<label for="second_amount">Second Dosage Amount:</label>');
        $response->assertSee('<input type="text" id="second_amount" name="second_amount">');
        $response->assertSee('<label for="second_unit">Second Dosage Unit:</label>');
        $response->assertSee('<input type="text" id="second_unit" name="second_unit">');
        $response->assertSee('<label for="second_type">Second Type:</label>');
        $response->assertSee('<input type="text" id="second_type" name="second_type">');
        $response->assertSee('<label for="comments">Comments:</label>');
        $response->assertSee('<input type="text" id="comments" name="comments">');
        $response->assertSee('<button type="button" id="med-format" class="btn btn-default">Format</button>');
        $response->assertSee('<p>Formatted code data:</p>');
        $response->assertSee('<p id="output"></p>');
    }
}
