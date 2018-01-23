<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicationEditPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasForm()
    {
        $user = factory(\App\User::class)->create();
        $medication = factory(\App\Medication::class)->create();
        $medication->update();
        $response = $this->actingAs($user)->get('/medications/' . $medication->medication_id . '/edit');
        $response->assertSee('<form id="medication-edit-form" class="form-horizontal" action="' . route('medications.update', ['id' => $medication->medication_id]) . '" method="POST">');
        $response->assertSee('<input class="form-control" type="text" name="name" value="' . $medication->name . '" id="med-name" required>');
        $response->assertSee('<input class="form-control" type="number" name="dosage_amount" value="' . $medication->dosage_amount . '" id="med-dosage-amount" required>');
        $response->assertSee('<input class="form-control" type="text" name="dosage_unit" value="' . $medication->dosage_unit . '" id="med-dosage-unit" required>');
        $response->assertSee('<input class="form-control" type="text" name="instructions" id="med-instructions" value="' . $medication->instructions . '" required>');
        $response->assertSee('<textarea class="form-control" rows="3" name="comments" id="med-comments" value="' . $medication->comments . '"></textarea>');
        $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
        $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
    }
}
