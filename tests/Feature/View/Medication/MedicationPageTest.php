<?php

namespace Tests\Feature\View\Medication;

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
        $response->assertSee('<h3>' . $medication->toString() . '</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $medication->primaryName() . '</p>');
        $response->assertSee('<h5><b><u>Dosage:</u></b></h5>');
        $response->assertSee('<p>' . d($medication->dosage_amount) . ' ' . $medication->dosage_unit . '</p>');
        $response->assertSee('<h5><b><u>Comments:</u></b></h5>');
        $response->assertSee('<p>' . $medication->comments . '</p>');
    }

    public function testHasComboMedication()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(\App\Medication::class)
            ->states(['secondary_name', 'combo'])
            ->create();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id);
        $response->assertSee('<h3>' . $medication->toString() . '</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $medication->primaryName() . '</p>');
        $response->assertSee('<h5><b><u>Dosage:</u></b></h5>');
        $response->assertSee('<p>' . d($medication->dosage_amount) . ' ' . $medication->dosage_unit . '</p>');
        $response->assertSee('<h5><b><u>Second Medication Name:</u></b></h5>');
        $response->assertSee('<p>' . $medication->secondaryName() . '</p>');
        $response->assertSee('<h5><b><u>Dosage:</u></b></h5>');
        $response->assertSee('<p>' . d($medication->second_amount) . ' ' . $medication->second_unit . '</p>');
        $response->assertSee('<h5><b><u>Comments:</u></b></h5>');
        $response->assertSee('<p>' . $medication->comments . '</p>');
    }

    public function testHasAmountMedication()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(\App\Medication::class)
            ->states(['secondary_name', 'amount'])
            ->create();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id);
        $response->assertSee('<h3>' . $medication->toString() . '</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $medication->primaryName() . '</p>');
        $response->assertSee('<h5><b><u>Dosage:</u></b></h5>');
        $response->assertSee('<p>' . d($medication->dosage_amount) . ' ' . $medication->dosage_unit . '</p>');
        $response->assertSee('<h5><b><u>With:</u></b></h5>');
        $response->assertSee('<p>' . d($medication->second_amount) . ' ' . $medication->second_unit . '</p>');
        $response->assertSee('<h5><b><u>Comments:</u></b></h5>');
        $response->assertSee('<p>' . $medication->comments . '</p>');

    }

    public function testHasInMedication()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(\App\Medication::class)
            ->states(['secondary_name', 'in'])
            ->create();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id);
        $response->assertSee('<h3>' . $medication->toString() . '</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $medication->primaryName() . '</p>');
        $response->assertSee('<h5><b><u>Dosage:</u></b></h5>');
        $response->assertSee('<p>' . d($medication->dosage_amount) . ' ' . $medication->dosage_unit . '</p>');
        $response->assertSee('<h5><b><u>In:</u></b></h5>');
        $response->assertSee('<p>' . $medication->secondaryName() . '</p>');
        $response->assertSee('<h5><b><u>Amount:</u></b></h5>');
        $response->assertSee('<p>' . d($medication->second_amount) . ' ' . $medication->second_unit . '</p>');
        $response->assertSee('<h5><b><u>Comments:</u></b></h5>');
        $response->assertSee('<p>' . $medication->comments . '</p>');

    }
}
