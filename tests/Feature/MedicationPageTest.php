<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicationPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasMedication()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(\App\Medication::class)->create();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id);
        $response->assertSee('<h3>' . $medication->name . '</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $medication->name . '</p>');
        $response->assertSee('<h5><b><u>Dosage:</u></b></h5>');
        $response->assertSee('<p>' . $medication->dosage_amount . ' ' . $medication->dosage_unit . '</p>');
        $response->assertSee('<h5><b><u>Comments:</u></b></h5>');
        $response->assertSee('<p>' . $medication->comments . '</p>');
    }
}
