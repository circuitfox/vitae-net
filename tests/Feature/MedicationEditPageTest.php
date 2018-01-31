<?php

namespace Tests\Feature;

use App\Medication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicationEditPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasForm()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(Medication::class)->create();
        $medication->update();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id . '/edit');
        $response->assertSee('<form id="medication-edit-form" class="form-horizontal" action="' . route('medications.update', ['id' => $medication->medication_id]) . '" method="POST">');
        $response->assertSee('<input class="form-control" type="text" name="name" value="' . $medication->primaryName() . '" id="med-name" required>');
        $response->assertSee('<input class="form-control" type="number" name="dosage_amount" value="' . $medication->dosage_amount . '" id="med-dosage-amount" required>');
        $response->assertSee('<input class="form-control" type="text" name="dosage_unit" value="' . $medication->dosage_unit . '" id="med-dosage-unit" required>');
        $response->assertSee('<select id="med-second-type" class="form-control" name="second_type" form="medication-form">');
        $response->assertSee('<input class="form-control" type="text" name="secondary_name" value="' . $medication->secondaryName() . '" id="med-secondary-name">');
        $response->assertSee('<input class="form-control" type="number" name="second_amount" value="' . $medication->second_amount . '" id="med-second-amount">');
        $response->assertSee('<input class="form-control" type="text" name="second_unit" value="' . $medication->second_unit . '" id="med-second-unit">');
        $response->assertSee('<option value="' . Medication::type_option($medication->second_type) . '" selected="selected"');
        $response->assertSee('<textarea class="form-control" rows="3" name="comments" id="med-comments" value="' . $medication->comments . '"></textarea>');
        $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
        $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
    }

    public function testHasFormSecondaryName()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(Medication::class)
            ->states(['secondary_name'])
            ->create();
        $medication->update();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id . '/edit');
        $response->assertSee('<form id="medication-edit-form" class="form-horizontal" action="' . route('medications.update', ['id' => $medication->medication_id]) . '" method="POST">');
        $response->assertSee('<input class="form-control" type="text" name="name" value="' . $medication->primaryName() . '" id="med-name" required>');
        $response->assertSee('<input class="form-control" type="number" name="dosage_amount" value="' . $medication->dosage_amount . '" id="med-dosage-amount" required>');
        $response->assertSee('<input class="form-control" type="text" name="dosage_unit" value="' . $medication->dosage_unit . '" id="med-dosage-unit" required>');
        $response->assertSee('<select id="med-second-type" class="form-control" name="second_type" form="medication-form">');
        $response->assertSee('<input class="form-control" type="text" name="secondary_name" value="' . $medication->secondaryName() . '" id="med-secondary-name">');
        $response->assertSee('<input class="form-control" type="number" name="second_amount" value="' . $medication->second_amount . '" id="med-second-amount">');
        $response->assertSee('<input class="form-control" type="text" name="second_unit" value="' . $medication->second_unit . '" id="med-second-unit">');
        $response->assertSee('<option value="' . Medication::type_option($medication->second_type) . '" selected="selected"');
        $response->assertSee('<textarea class="form-control" rows="3" name="comments" id="med-comments" value="' . $medication->comments . '"></textarea>');
        $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
        $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
    }

    public function testHasFormCombo()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(Medication::class)
            ->states(['secondary_name', 'combo'])
            ->create();
        $medication->update();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id . '/edit');
        $response->assertSee('<form id="medication-edit-form" class="form-horizontal" action="' . route('medications.update', ['id' => $medication->medication_id]) . '" method="POST">');
        $response->assertSee('<input class="form-control" type="text" name="name" value="' . $medication->primaryName() . '" id="med-name" required>');
        $response->assertSee('<input class="form-control" type="number" name="dosage_amount" value="' . $medication->dosage_amount . '" id="med-dosage-amount" required>');
        $response->assertSee('<input class="form-control" type="text" name="dosage_unit" value="' . $medication->dosage_unit . '" id="med-dosage-unit" required>');
        $response->assertSee('<select id="med-second-type" class="form-control" name="second_type" form="medication-form">');
        $response->assertSee('<input class="form-control" type="text" name="secondary_name" value="' . $medication->secondaryName() . '" id="med-secondary-name">');
        $response->assertSee('<input class="form-control" type="number" name="second_amount" value="' . $medication->second_amount . '" id="med-second-amount">');
        $response->assertSee('<input class="form-control" type="text" name="second_unit" value="' . $medication->second_unit . '" id="med-second-unit">');
        $response->assertSee('<option value="' . Medication::type_option('combo') . '" selected="selected"');
        $response->assertSee('<textarea class="form-control" rows="3" name="comments" id="med-comments" value="' . $medication->comments . '"></textarea>');
        $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
        $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
    }

    public function testHasFormAmount()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(Medication::class)
            ->states(['secondary_name', 'amount'])
            ->create();
        $medication->update();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id . '/edit');
        $response->assertSee('<form id="medication-edit-form" class="form-horizontal" action="' . route('medications.update', ['id' => $medication->medication_id]) . '" method="POST">');
        $response->assertSee('<input class="form-control" type="text" name="name" value="' . $medication->primaryName() . '" id="med-name" required>');
        $response->assertSee('<input class="form-control" type="number" name="dosage_amount" value="' . $medication->dosage_amount . '" id="med-dosage-amount" required>');
        $response->assertSee('<input class="form-control" type="text" name="dosage_unit" value="' . $medication->dosage_unit . '" id="med-dosage-unit" required>');
        $response->assertSee('<select id="med-second-type" class="form-control" name="second_type" form="medication-form">');
        $response->assertSee('<input class="form-control" type="text" name="secondary_name" value="' . $medication->secondaryName() . '" id="med-secondary-name">');
        $response->assertSee('<input class="form-control" type="number" name="second_amount" value="' . $medication->second_amount . '" id="med-second-amount">');
        $response->assertSee('<input class="form-control" type="text" name="second_unit" value="' . $medication->second_unit . '" id="med-second-unit">');
        $response->assertSee('<option value="' . Medication::type_option('amount') . '" selected="selected"');
        $response->assertSee('<textarea class="form-control" rows="3" name="comments" id="med-comments" value="' . $medication->comments . '"></textarea>');
        $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
        $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
    }

    public function testHasFormIn()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(Medication::class)
            ->states(['secondary_name', 'in'])
            ->create();
        $medication->update();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id . '/edit');
        $response->assertSee('<form id="medication-edit-form" class="form-horizontal" action="' . route('medications.update', ['id' => $medication->medication_id]) . '" method="POST">');
        $response->assertSee('<input class="form-control" type="text" name="name" value="' . $medication->primaryName() . '" id="med-name" required>');
        $response->assertSee('<input class="form-control" type="number" name="dosage_amount" value="' . $medication->dosage_amount . '" id="med-dosage-amount" required>');
        $response->assertSee('<input class="form-control" type="text" name="dosage_unit" value="' . $medication->dosage_unit . '" id="med-dosage-unit" required>');
        $response->assertSee('<select id="med-second-type" class="form-control" name="second_type" form="medication-form">');
        $response->assertSee('<input class="form-control" type="text" name="secondary_name" value="' . $medication->secondaryName() . '" id="med-secondary-name">');
        $response->assertSee('<input class="form-control" type="number" name="second_amount" value="' . $medication->second_amount . '" id="med-second-amount">');
        $response->assertSee('<input class="form-control" type="text" name="second_unit" value="' . $medication->second_unit . '" id="med-second-unit">');
        $response->assertSee('<option value="' . Medication::type_option('in') . '" selected="selected"');
        $response->assertSee('<textarea class="form-control" rows="3" name="comments" id="med-comments" value="' . $medication->comments . '"></textarea>');
        $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
        $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
    }
}
