<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarEntriesCreatePageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasMarFormList()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($user)->get('/mars/create/' . $patient->medical_record_number);
        $response->assertSee('<mar-form-list :errors=');
        $response->assertSee(':old=');
        $response->assertSee(':meds=');
        $response->assertSee(':mrn=');
        $response->assertSee('</mar-form-list>');
    }

    public function testHasAddButton()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($user)->get('/mars/create/' . $patient->medical_record_number);
        $response->assertSee('<button class="btn btn-default" type="button" id="add-mar">Add</button>');
    }
}
