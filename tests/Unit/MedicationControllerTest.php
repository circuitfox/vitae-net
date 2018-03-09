<?php

namespace Tests\Unit;

use App\MarEntry;
use App\Medication;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/medications');
        $response->assertViewIs('admin.medications');
    }

    public function testCreate()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->get('/medications/create');
        $response->assertViewIs('admin.medications.create');
    }

    public function testCreateInstructorOrAdmin()
    {
        $instructor = factory(User::class)->states('instructor')->create();
        $user = factory(User::class)->states('student')->create();
        $this->assertFalse($user->isAdmin());
        $this->assertEquals($instructor->role, 'instructor');
        $response = $this->actingAs($instructor)->get('/medications/create');
        $response->assertViewIs('admin.medications.create');
        $response = $this->actingAs($user)->get('/medications/create');
        $response->assertStatus(403);
    }

    public function testStore()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->post('/medications', [
            'meds' => [[
                'name' => 'Wellbutrin',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'comments' => '',
            ]],
        ]);
        $response->assertRedirect('/home');
        $med = Medication::where([
            'name' => 'Wellbutrin',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
            'comments' => null,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Wellbutrin');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertNull($med->second_amount);
        $this->assertNull($med->second_unit);
        $this->assertNull($med->second_type);
        $this->assertNull($med->comments);
    }

    public function testStoreWithSecondaries()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->post('/medications', [
            'meds' => [[
                'name' => 'acetominophin|hydrocodeine',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'second_amount' => 20,
                'second_unit' => 'mg',
                'second_type' => 'combo',
                'comments' => 'not more than four a day',
            ]],
        ]);
        $response->assertRedirect('/home');
        $med = Medication::where([
            'name' => 'acetominophin|hydrocodeine',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
            'second_amount' => 20,
            'second_unit' => 'mg',
            'second_type' => 'combo',
            'comments' => 'not more than four a day',
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->primaryName(), 'acetominophin');
        $this->assertEquals($med->secondaryName(), 'hydrocodeine');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->second_amount, 20);
        $this->assertEquals($med->second_unit, 'mg');
        $this->assertEquals($med->second_type, 'combo');
        $this->assertEquals($med->comments, 'not more than four a day');
        $response = $this->actingAs($admin)->post('/medications', [
            'meds' => [[
                'name' => 'ancef|normal saline',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'second_amount' => 100,
                'second_unit' => 'mL',
                'second_type' => 'in',
                'comments' => '',
            ]],
        ]);
        $response->assertRedirect('/home');
        $med = Medication::where([
            'name' => 'ancef|normal saline',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
            'second_amount' => 100,
            'second_unit' => 'mL',
            'second_type' => 'in',
            'comments' => null,
        ])->first();
        $this->assertEquals($med->primaryName(), 'ancef');
        $this->assertEquals($med->secondaryName(), 'normal saline');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->second_amount, 100);
        $this->assertEquals($med->second_unit, 'mL');
        $this->assertEquals($med->second_type, 'in');
        $this->assertNull($med->comments);
        $response = $this->actingAs($admin)->post('/medications', [
            'meds' => [[
                'name' => 'regular insulin',
                'dosage_amount' => 10,
                'dosage_unit' => 'mL',
                'second_amount' => 100,
                'second_unit' => 'units/mL',
                'second_type' => 'amount',
                'comments' => '',
            ]],
        ]);
        $response->assertRedirect('/home');
        $med = Medication::where([
            'name' => 'regular insulin',
            'dosage_amount' => 10,
            'dosage_unit' => 'mL',
            'second_amount' => 100,
            'second_unit' => 'units/mL',
            'second_type' => 'amount',
            'comments' => null,
        ])->first();
        $this->assertEquals($med->primaryName(), 'regular insulin');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mL');
        $this->assertEquals($med->second_amount, 100);
        $this->assertEquals($med->second_unit, 'units/mL');
        $this->assertEquals($med->second_type, 'amount');
        $this->assertEquals($med->secondaryName(), '');
        $this->assertNull($med->comments);
    }

    public function testStoreNullables()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->post('/medications', [
            'meds' => [[
                'name' => 'Wellbutrin',
            ]],
        ]);
        $response->assertRedirect('/home');
        $med = Medication::where([
            'name' => 'Wellbutrin',
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Wellbutrin');
        $this->assertNull($med->dosage_amount);
        $this->assertNull($med->dosage_unit);
        $this->assertNull($med->second_amount);
        $this->assertNull($med->second_unit);
        $this->assertNull($med->second_type);
        $this->assertNull($med->comments);

    }

    public function testStoreInstructorOrAdmin()
    {
        $instructor = factory(User::class)->states('instructor')->create();
        $user = factory(User::class)->states('student')->create();
        $response = $this->actingAs($instructor)->post('/medications', [
            'meds' => [[
                'name' => 'Wellbutrin',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'comments' => '',
            ]],
        ]);
        $response->assertRedirect('/home');
        $med = Medication::where([
            'name' => 'Wellbutrin',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
            'comments' => null,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Wellbutrin');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertNull($med->comments);
        $response = $this->actingAs($user)->post('/medications', [
            'meds' => [[
                'name' => 'Wellbutrin',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'comments' => '',
            ]],
        ]);
        $response->assertStatus(403);
    }

    public function testStoreMultiple()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->post('/medications', [
            'meds' => [
                [
                'name' => 'Wellbutrin',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'comments' => '',
                ],
                [
                'name' => 'Aspirin',
                'dosage_amount' => 50,
                'dosage_unit' => 'mg',
                'comments' => '',
                ],
            ],
        ]);
        $response->assertRedirect('/home');
        $med = Medication::where([
            'name' => 'Wellbutrin',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
            'comments' => null,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Wellbutrin');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertNull($med->comments);
        $med = Medication::where([
            'name' => 'Aspirin',
            'dosage_amount' => 50,
            'dosage_unit' => 'mg',
            'comments' => null,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Aspirin');
        $this->assertEquals($med->dosage_amount, 50);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertNull($med->comments);
    }

    public function testStoreMultipleWithSecondaries()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->post('/medications', [
            'meds' => [
                [
                'name' => 'ancef|normal saline',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'second_amount' => 100,
                'second_unit' => 'mL',
                'second_type' => 'in',
                'comments' => '',
                ],
                [
                'name' => 'acetominophin|aspirin',
                'dosage_amount' => 50,
                'dosage_unit' => 'mg',
                'second_amount' => 100,
                'second_unit' => 'mg',
                'second_type' => 'combo',
                'comments' => '',
                ],
            ],
        ]);
        $response->assertRedirect('/home');
        $med = Medication::where([
          'name' => 'ancef|normal saline',
          'dosage_amount' => 10,
          'dosage_unit' => 'mg',
          'second_amount' => 100,
          'second_unit' => 'mL',
          'second_type' => 'in',
          'comments' => null,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->primaryName(), 'ancef');
        $this->assertEquals($med->secondaryName(), 'normal saline');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->second_amount, 100);
        $this->assertEquals($med->second_unit, 'mL');
        $this->assertEquals($med->second_type, 'in');
        $this->assertNull($med->comments);
        $med = Medication::where([
          'name' => 'acetominophin|aspirin',
          'dosage_amount' => 50,
          'dosage_unit' => 'mg',
          'second_amount' => 100,
          'second_unit' => 'mg',
          'second_type' => 'combo',
          'comments' => null,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->primaryName(), 'acetominophin');
        $this->assertEquals($med->secondaryName(), 'aspirin');
        $this->assertEquals($med->dosage_amount, 50);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->second_amount, 100);
        $this->assertEquals($med->second_unit, 'mg');
        $this->assertEquals($med->second_type, 'combo');
        $this->assertNull($med->comments);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $med = factory(Medication::class)->create();
        $response = $this->actingAs($user)->get('/medications/' . $med->medication_id);
        $response->assertViewIs('admin.medication');
    }

    public function testEdit()
    {
        $admin = factory(User::class)->states('admin')->create();
        $med = factory(Medication::class)->create();
        $response = $this->actingAs($admin)->get('/medications/' . $med->medication_id . '/edit');
        $response->assertViewIs('admin.medication.edit');
    }

    public function testEditInstructorOrAdmin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $user = factory(User::class)->states('student')->create();
        $med = factory(Medication::class)->create();
        $response = $this->actingAs($admin)->get('/medications/' . $med->medication_id . '/edit');
        $response->assertViewIs('admin.medication.edit');
        $response = $this->actingAs($instructor)->get('/medications/' . $med->medication_id . '/edit');
        $response->assertViewIs('admin.medication.edit');
        $response = $this->actingAs($user)->get('/medications/' . $med->medication_id . '/edit');
        $response->assertStatus(403);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->states('admin')->create();
        $med = factory(Medication::class)->create();
        $response = $this->actingAs($user)->put('/medications/' . $med->medication_id, [
            'name' => $med->name,
            'dosage_amount' => 50,
            'dosage_unit' => $med->dosage_unit,
            'comments' => '',
        ]);
        $response->assertRedirect('/home');
        $med1 = Medication::find($med->medication_id);
        $this->assertEquals($med1->name, $med->name);
        $this->assertEquals($med1->dosage_amount, 50);
        $this->assertEquals($med1->dosage_unit, $med->dosage_unit);
        $this->assertEquals($med1->second_amount, $med->second_amount);
        $this->assertEquals($med1->second_unit, $med->second_unit);
        $this->assertEquals($med1->second_type, $med->second_type);
        $this->assertEquals($med1->comments, null);
    }

    public function testUpdateSecondaryName()
    {
        $user = factory(User::class)->states('admin')->create();
        $med = factory(Medication::class)
            ->states(['secondary_name'])
            ->create();
        $response = $this->actingAs($user)->put('/medications/' . $med->medication_id, [
            'name' => $med->secondaryName(),
            'dosage_amount' => $med->dosage_amount,
            'dosage_unit' => $med->dosage_unit,
            'secondary_name' => $med->primaryName(),
        ]);
        $response->assertRedirect('/home');
        $med1 = Medication::find($med->medication_id);
        $this->assertEquals($med1->name, $med->secondaryName() . Medication::NAME_SEPARATOR . $med->primaryName());
        $this->assertEquals($med1->dosage_amount, $med->dosage_amount);
        $this->assertEquals($med1->dosage_unit, $med->dosage_unit);
        $this->assertEquals($med1->second_amount, $med->second_amount);
        $this->assertEquals($med1->second_unit, $med->second_unit);
        $this->assertEquals($med1->second_type, $med->second_type);
        $this->assertEquals($med1->comments, $med->comments);
    }

    public function testUpdateSecondaryType()
    {
        $user = factory(User::class)->states('admin')->create();
        $med = factory(Medication::class)
            ->states(['secondary_name', 'in'])
            ->create();
        $response = $this->actingAs($user)->put('/medications/' . $med->medication_id, [
            'name' => $med->primaryName(),
            'dosage_amount' => $med->dosage_amount,
            'dosage_unit' => $med->dosage_unit,
            'secondary_name' => $med->secondaryName(),
            'second_type' => 'combo',
        ]);
        $response->assertRedirect('/home');
        $med1 = Medication::find($med->medication_id);
        $this->assertEquals($med1->name, $med->name);
        $this->assertEquals($med1->dosage_amount, $med->dosage_amount);
        $this->assertEquals($med1->dosage_unit, $med->dosage_unit);
        $this->assertEquals($med1->second_amount, $med->second_amount);
        $this->assertEquals($med1->second_unit, $med->second_unit);
        $this->assertEquals($med1->second_type, 'combo');
        $this->assertEquals($med1->comments, $med->comments);
    }

    public function testDelete()
    {
        $user = factory(User::class)->states('admin')->create();
        $med = factory(Medication::class)->create();
        $response = $this->actingAs($user)->delete('/medications/' . $med->medication_id);
        $response->assertRedirect();
        $this->assertNull(Medication::find($med->medication_id));
    }

    public function testDeleteInstructorOrAdmin()
    {
        $user = factory(User::class)->states('student')->create();
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $med = factory(Medication::class)->create();
        $med1 = factory(Medication::class)->create();
        $response = $this->actingAs($admin)->delete('/medications/' . $med->medication_id);
        $response->assertRedirect();
        $this->assertNull(Medication::find($med->medication_id));
        $response = $this->actingAs($user)->delete('/medications/' . $med1->medication_id);
        $response->assertStatus(403);
        $this->assertNotNull(Medication::find($med1->medication_id));
        $response = $this->actingAs($instructor)->delete('/medications/' . $med1->medication_id);
        $response->assertRedirect();
        $this->assertNull(Medication::find($med1->medication_id));
    }

    public function testDeleteMarEntries()
    {
        $user = factory(User::class)->states('admin')->create();
        $marEntry = factory(MarEntry::class)->create();
        $medication = $marEntry->medication;
        $response = $this->actingAs($user)->delete('/medications/' . $medication->medication_id);
        $response->assertRedirect();
        $this->assertNull(Medication::find($medication->medication_id));
        $this->assertNull(MarEntry::find($marEntry->id));
    }

    public function testVerify()
    {
        $med = factory(Medication::class)->create();
        $response = $this->json('POST', '/api/v1/medications/verify', [
            'name' => $med->primaryName(),
            'dosage_amount' => $med->dosage_amount,
            'dosage_unit' => $med->dosage_unit,
            'secondary_name' => $med->secondaryName(),
            'second_amount' => $med->second_amount,
            'second_unit' => $med->second_unit,
            'second_type' => $med->second_type,
            'comments' => $med->comments,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'name' => $med->primaryName(),
                'dosage_amount' => $med->dosage_amount,
                'dosage_unit' => $med->dosage_unit,
                'secondary_name' => $med->secondaryName(),
                'second_amount' => $med->second_amount,
                'second_unit' => $med->second_unit,
                'second_type' => $med->second_type,
                'comments' => $med->comments,
            ]
        ]);
    }

    public function testVerifyError()
    {
        $response = $this->json('POST', '/api/v1/medications/verify', [
            'name' => 'Wellbutrin',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
        ]);
        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'data',
        ]);
        $response->assertJsonFragment(['status' => 'error']);
    }

    public function testVerifyBarcode()
    {
        $med = factory(Medication::class)->create();
        $response = $this->json('POST', '/api/v2/medications/verify', [
            'medication_id' => $med->medication_id,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'name' => $med->primaryName(),
                'dosage_amount' => $med->dosage_amount,
                'dosage_unit' => $med->dosage_unit,
                'secondary_name' => $med->secondaryName(),
                'second_amount' => $med->second_amount,
                'second_unit' => $med->second_unit,
                'second_type' => $med->second_type,
                'comments' => $med->comments,
            ]
        ]);
    }

    public function testVerifyBarcodeError()
    {
        $response = $this->json('POST', '/api/v2/medications/verify', [
            'medication_id' => 1,
        ]);
        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'data',
        ]);
        $response->assertJsonFragment(['status' => 'error']);
    }
}
