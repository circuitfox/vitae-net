<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicationsCreatePageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasMedicationFormList()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/medications/create');
        $response->assertSee('<medication-form-list :errors=');
        $response->assertSee(':old=');
        $response->assertSee('</medication-form-list>');
    }

    public function testHasAddButton()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/medications/create');
        $response->assertSee('<button class="btn btn-default" type="button" id="add-medication">Add</button>');
    }
}
