<?php

namespace Tests\Unit;

use App\MarEntry;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarEntryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->get('/mars/create');
        $response->assertViewIs('admin.mar.create');
    }

    public function testCreateInstructorOrAdmin()
    {
        $instructor = factory(User::class)->states('instructor')->create();
        $user = factory(User::class)->states('student')->create();
        $this->assertFalse($user->isAdmin());
        $this->assertEquals($instructor->role, 'instructor');
        $response = $this->actingAs($instructor)->get('/mars/create');
        $response->assertViewIs('admin.mar.create');
        $response = $this->actingAs($user)->get('/mars/create');
        $response->assertStatus(403);
    }

    public function testStore()
    {
        $admin = factory(User::class)->states('admin')->create();
        $medication = factory(\App\Medication::class)->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($admin)->post('/mars', [
            'mars' => [[
                'instructions' => 'once every 4 hours',
                'stat' => false,
                'medical_record_number' => $patient->medical_record_number,
                'medication_id' => $medication->medication_id,
                'given_at' => [0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            ]]
        ]);
        $response->assertRedirect();
        $mar_entry = MarEntry::where([
            'instructions' => 'once every 4 hours',
            'stat' => false,
            'medical_record_number' => $patient->medical_record_number,
            'medication_id' => $medication->medication_id,
            'given_at' => 4,
        ])->first();
        $this->assertNotNull($mar_entry);
        $this->assertNotNull($mar_entry->patient);
        $this->assertNotNull($mar_entry->medication);
        $this->assertNotNull($patient->marEntries);
        $this->assertNotNull($medication->marEntries);
        $this->assertEquals(0, $mar_entry->stat);
        $this->assertEquals('once every 4 hours', $mar_entry->instructions);
        $this->assertEquals(4, $mar_entry->given_at);
    }

    public function testStoreMultiple()
    {
        $admin = factory(User::class)->states('admin')->create();
        $medication = factory(\App\Medication::class)->create();
        $medication1 = factory(\App\Medication::class)->create();
        $medication2 = factory(\App\Medication::class)->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($admin)->post('/mars', [
            'mars' => [
                [
                    'instructions' => 'once every 4 hours',
                    'stat' => false,
                    'medical_record_number' => $patient->medical_record_number,
                    'medication_id' => $medication->medication_id,
                    'given_at' => [0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0],
                ],
                [
                    'instructions' => 'by mouth',
                    'stat' => true,
                    'medical_record_number' => $patient->medical_record_number,
                    'medication_id' => $medication1->medication_id,
                    'given_at' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                ],
                [
                    'instructions' => 'once every 8 hours',
                    'stat' => false,
                    'medical_record_number' => $patient->medical_record_number,
                    'medication_id' => $medication2->medication_id,
                    'given_at' => [0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
                ],
        ]]);
        $response->assertRedirect();
        $mar_entry = MarEntry::where([
            'instructions' => 'once every 4 hours',
            'stat' => false,
            'medical_record_number' => $patient->medical_record_number,
            'medication_id' => $medication->medication_id,
            'given_at' => 0x222,
        ])->first();
        $this->assertNotNull($mar_entry);
        $this->assertNotNull($mar_entry->patient);
        $this->assertNotNull($mar_entry->medication);
        $this->assertNotNull($patient->marEntries[0]);
        $this->assertNotNull($medication->marEntries[0]);
        $this->assertEquals(0, $mar_entry->stat);
        $this->assertEquals('once every 4 hours', $mar_entry->instructions);
        $this->assertEquals(0x222, $mar_entry->given_at);

        $mar_entry = MarEntry::where([
            'instructions' => 'by mouth',
            'stat' => true,
            'medical_record_number' => $patient->medical_record_number,
            'medication_id' => $medication1->medication_id,
            'given_at' => 0,
        ])->first();
        $this->assertNotNull($mar_entry);
        $this->assertNotNull($mar_entry->patient);
        $this->assertNotNull($mar_entry->medication);
        $this->assertNotNull($patient->marEntries[1]);
        $this->assertNotNull($medication1->marEntries[0]);
        $this->assertEquals(1, $mar_entry->stat);
        $this->assertEquals('by mouth', $mar_entry->instructions);
        $this->assertEquals(0, $mar_entry->given_at);

        $mar_entry = MarEntry::where([
            'instructions' => 'once every 8 hours',
            'stat' => false,
            'medical_record_number' => $patient->medical_record_number,
            'medication_id' => $medication2->medication_id,
            'given_at' => 0x202,
        ])->first();
        $this->assertNotNull($mar_entry);
        $this->assertNotNull($mar_entry->patient);
        $this->assertNotNull($mar_entry->medication);
        $this->assertNotNull($patient->marEntries[2]);
        $this->assertNotNull($medication1->marEntries[0]);
        $this->assertEquals(0, $mar_entry->stat);
        $this->assertEquals('once every 8 hours', $mar_entry->instructions);
        $this->assertEquals(0x202, $mar_entry->given_at);
    }

    public function testStoreInstructorOrAdmin()
    {
        $instructor = factory(User::class)->states('instructor')->create();
        $user = factory(User::class)->states('student')->create();
        $medication = factory(\App\Medication::class)->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($instructor)->post('/mars', [
            'mars' => [[
                'instructions' => 'once every 4 hours',
                'stat' => false,
                'medical_record_number' => $patient->medical_record_number,
                'medication_id' => $medication->medication_id,
                'given_at' => [0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            ]]
        ]);
        $response->assertRedirect();
        $mar_entry = MarEntry::where([
            'instructions' => 'once every 4 hours',
            'stat' => false,
            'medical_record_number' => $patient->medical_record_number,
            'medication_id' => $medication->medication_id,
            'given_at' => 4,
        ])->first();
        $this->assertNotNull($mar_entry);
        $this->assertNotNull($mar_entry->patient);
        $this->assertNotNull($mar_entry->medication);
        $this->assertNotNull($patient->marEntries);
        $this->assertNotNull($medication->marEntries);
        $this->assertEquals(0, $mar_entry->stat);
        $this->assertEquals('once every 4 hours', $mar_entry->instructions);
        $this->assertEquals(4, $mar_entry->given_at);

        $medication = factory(\App\Medication::class)->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($user)->post('/mars', [
            'mars' => [[
                'instructions' => 'once every 4 hours',
                'stat' => false,
                'medical_record_number' => $patient->medical_record_number,
                'medication_id' => $medication->medication_id,
                'given_at' => [0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            ]]
        ]);
        $response->assertStatus(403);
        $mar_entry = MarEntry::where([
            'instructions' => 'once every 4 hours',
            'stat' => false,
            'medical_record_number' => $patient->medical_record_number,
            'medication_id' => $medication->medication_id,
            'given_at' => 4,
        ])->first();
        $this->assertNull($mar_entry);
    }

    public function testUpdate()
    {
        $admin = factory(User::class)->states('admin')->create();
        $mar_entry = factory(MarEntry::class)->create();
        $response = $this->actingAs($admin)->put('/mars/' . $mar_entry->id, [
            'instructions' => 'once every 4 hours',
            'stat' => $mar_entry->stat,
            'given_at' => [0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0],
            'medication_id' => $mar_entry->medication->medication_id,
        ]);
        $response->assertRedirect();
        $updated_mar_entry = MarEntry::where([
            'instructions' => 'once every 4 hours',
            'stat' => $mar_entry->stat,
            'medical_record_number' => $mar_entry->patient->medical_record_number,
            'medication_id' => $mar_entry->medication->medication_id,
            'given_at' => 0x222,
        ])->first();
        $this->assertNotNull($updated_mar_entry);
        $this->assertNotNull($updated_mar_entry->patient);
        $this->assertNotNull($updated_mar_entry->medication);
        $this->assertEquals('once every 4 hours', $updated_mar_entry->instructions);
        $this->assertEquals($mar_entry->stat, $updated_mar_entry->stat);
        $this->assertEquals($mar_entry->patient, $updated_mar_entry->patient);
        $this->assertEquals($mar_entry->medication, $updated_mar_entry->medication);
        $this->assertEquals(0x222, $updated_mar_entry->given_at);

        $mar_entry = factory(MarEntry::class)->create();
        $medication = factory(\App\Medication::class)->create();
        $response = $this->actingAs($admin)->put('/mars/' . $mar_entry->id, [
            'instructions' => $mar_entry->instructions,
            'stat' => $mar_entry->stat,
            'medication_id' => $medication->medication_id,
        ]);
        $response->assertRedirect();
        $updated_mar_entry = MarEntry::where([
            'instructions' => $mar_entry->instructions,
            'stat' => $mar_entry->stat,
            'medical_record_number' => $mar_entry->patient->medical_record_number,
            'medication_id' => $medication->medication_id,
            'given_at' => $mar_entry->given_at,
        ])->first();
        $this->assertNotNull($updated_mar_entry);
        $this->assertNotNull($updated_mar_entry->patient);
        $this->assertNotNull($updated_mar_entry->medication);
        $this->assertEquals($mar_entry->instructions, $updated_mar_entry->instructions);
        $this->assertEquals($mar_entry->stat, $updated_mar_entry->stat);
        $this->assertEquals($mar_entry->patient, $updated_mar_entry->patient);
        $this->assertNotEquals($mar_entry->medication, $updated_mar_entry->medication);
        $this->assertEquals($mar_entry->given_at, $updated_mar_entry->given_at);
    }

    public function testUpdateInstructorOrAdmin()
    {
        $instructor = factory(User::class)->states('instructor')->create();
        $user = factory(User::class)->states('student')->create();
        $mar_entry = factory(MarEntry::class)->create();
        $response = $this->actingAs($instructor)->put('/mars/' . $mar_entry->id, [
            'instructions' => 'once every 4 hours',
            'stat' => $mar_entry->stat,
            'given_at' => [0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0],
            'medication_id' => $mar_entry->medication->medication_id,
        ]);
        $response->assertRedirect();
        $updated_mar_entry = MarEntry::where([
            'instructions' => 'once every 4 hours',
            'stat' => $mar_entry->stat,
            'medical_record_number' => $mar_entry->patient->medical_record_number,
            'medication_id' => $mar_entry->medication->medication_id,
            'given_at' => 0x222,
        ])->first();
        $this->assertNotNull($updated_mar_entry);
        $this->assertNotNull($updated_mar_entry->patient);
        $this->assertNotNull($updated_mar_entry->medication);
        $this->assertEquals('once every 4 hours', $updated_mar_entry->instructions);
        $this->assertEquals($mar_entry->stat, $updated_mar_entry->stat);
        $this->assertEquals($mar_entry->patient, $updated_mar_entry->patient);
        $this->assertEquals($mar_entry->medication, $updated_mar_entry->medication);
        $this->assertEquals(0x222, $updated_mar_entry->given_at);

        $response = $this->actingAs($user)->put('/mars/' . $mar_entry->id, [
            'instructions' => 'once every 2 hours',
            'stat' => $mar_entry->stat,
            'given_at' => [0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0],
            'medication_id' => $mar_entry->medication->medication_id,
        ]);
        $response->assertStatus(403);
        $updated_mar_entry = MarEntry::where([
            'instructions' => 'once every 2 hours',
            'stat' => $mar_entry->stat,
            'medical_record_number' => $mar_entry->patient->medical_record_number,
            'medication_id' => $mar_entry->medication->medication_id,
            'given_at' => 0xaaa,
        ])->first();
        $this->assertNull($updated_mar_entry);
    }
}
