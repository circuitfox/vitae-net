<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasEntries()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $marEntry = factory(\App\MarEntry::class)->create();
        $meds = [$marEntry->Medication->toMarArray()];
        $complete = session('complete.' . $marEntry->medical_record_number);
        if ($complete === null) {
            $complete = [];
        }
        $response = $this->actingAs($user)->get('/mars/' . $marEntry->medical_record_number);
        $response->assertSee('Viewing MAR for '
            . $this->faker_escape($marEntry->patient->first_name . ' ' . $marEntry->patient->last_name)
            . ' (MRN: ' . $marEntry->medical_record_number . ')');
        $response->assertSee('<tr is="mar-entry"');
        $response->assertSee(':meds="' . $this->faker_escape(json_encode($meds)) . '"');
        $response->assertSee(':mar-entry="' . $this->faker_escape($marEntry->toJsonArray()) . '"');
        $response->assertSee(':is-admin="' . $this->faker_escape(json_encode($user->isAdmin())) . '"');
        $response->assertSee('route="' . route('mars.update', ['id' => $marEntry->id]) . '"');
        $response->assertSee(':complete="' . $this->faker_escape(json_encode($complete)) . '">');
    }
}
