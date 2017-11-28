<?php

namespace Tests\Unit;

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
        $user = factory(User::class)->create();
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
                'instructions' => '1 by mouth every 4 hours',
                'comments' => '',
                'stat' => false,
            ]],
        ]);
        $response->assertRedirect('/admin');
        $med = Medication::where([
            'name' => 'Wellbutrin',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
            'instructions' => '1 by mouth every 4 hours',
            'comments' => null,
            'stat' => false,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Wellbutrin');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->instructions, '1 by mouth every 4 hours');
        $this->assertNull($med->comments);
        $this->assertEquals($med->stat, 0);
    }

    public function testStoreInstructorOrAdmin()
    {
        $instructor = factory(User::class)->states('instructor')->create();
        $user = factory(User::class)->create();
        $response = $this->actingAs($instructor)->post('/medications', [
            'meds' => [[
                'name' => 'Wellbutrin',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'instructions' => '1 by mouth every 4 hours',
                'comments' => '',
                'stat' => false,
            ]],
        ]);
        $response->assertRedirect('/admin');
        $med = Medication::where([
            'name' => 'Wellbutrin',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
            'instructions' => '1 by mouth every 4 hours',
            'comments' => null,
            'stat' => false,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Wellbutrin');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->instructions, '1 by mouth every 4 hours');
        $this->assertNull($med->comments);
        $this->assertEquals($med->stat, 0);
        $response = $this->actingAs($user)->post('/medications', [
            'meds' => [[
                'name' => 'Wellbutrin',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'instructions' => '1 by mouth every 4 hours',
                'comments' => '',
                'stat' => false,
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
                'instructions' => '1 by mouth every 4 hours',
                'comments' => '',
                'stat' => false,
                ],
                [
                'name' => 'Aspirin',
                'dosage_amount' => 50,
                'dosage_unit' => 'mg',
                'instructions' => '1 by mouth every 6 hours',
                'comments' => '',
                'stat' => true,
                ],
            ],
        ]);
        $response->assertRedirect('/admin');
        $med = Medication::where([
            'name' => 'Wellbutrin',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
            'instructions' => '1 by mouth every 4 hours',
            'comments' => null,
            'stat' => false,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Wellbutrin');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->instructions, '1 by mouth every 4 hours');
        $this->assertNull($med->comments);
        $this->assertEquals($med->stat, 0);
        $med = Medication::where([
            'name' => 'Aspirin',
            'dosage_amount' => 50,
            'dosage_unit' => 'mg',
            'instructions' => '1 by mouth every 6 hours',
            'comments' => null,
            'stat' => true,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Aspirin');
        $this->assertEquals($med->dosage_amount, 50);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->instructions, '1 by mouth every 6 hours');
        $this->assertNull($med->comments);
        $this->assertEquals($med->stat, 1);
    }

    public function testStoreStatNullOrEmpty()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->post('/medications', [
            'meds' => [
                [
                'name' => 'Wellbutrin',
                'dosage_amount' => 10,
                'dosage_unit' => 'mg',
                'instructions' => '1 by mouth every 4 hours',
                'comments' => '',
                ],
                [
                'name' => 'Aspirin',
                'dosage_amount' => 50,
                'dosage_unit' => 'mg',
                'instructions' => '1 by mouth every 6 hours',
                'comments' => '',
                'stat' => null,
                ],
            ],
        ]);
        $response->assertRedirect('/admin');

        $med = Medication::where([
            'name' => 'Wellbutrin',
            'dosage_amount' => 10,
            'dosage_unit' => 'mg',
            'instructions' => '1 by mouth every 4 hours',
            'comments' => null,
            'stat' => false,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Wellbutrin');
        $this->assertEquals($med->dosage_amount, 10);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->instructions, '1 by mouth every 4 hours');
        $this->assertNull($med->comments);
        $this->assertEquals($med->stat, 0);

        $med = Medication::where([
            'name' => 'Aspirin',
            'dosage_amount' => 50,
            'dosage_unit' => 'mg',
            'instructions' => '1 by mouth every 6 hours',
            'comments' => null,
            'stat' => false,
        ])->first();
        $this->assertNotNull($med);
        $this->assertEquals($med->name, 'Aspirin');
        $this->assertEquals($med->dosage_amount, 50);
        $this->assertEquals($med->dosage_unit, 'mg');
        $this->assertEquals($med->instructions, '1 by mouth every 6 hours');
        $this->assertNull($med->comments);
        $this->assertEquals($med->stat, 0);
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
        $user = factory(User::class)->create();
        $med = factory(Medication::class)->create();
        $response = $this->actingAs($user)->get('/medications/' . $med->medication_id . '/edit');
        $response->assertViewIs('admin.medication.edit');
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $med = factory(Medication::class)->create();
        $response = $this->actingAs($user)->put('/medications/' . $med->medication_id, [
            'name' => $med->name,
            'dosage_amount' => 50,
            'dosage_unit' => $med->dosage_unit,
            'instructions' => $med->instructions,
            'comments' => '',
            'stat' => false,
        ]);
        $response->assertRedirect('/admin');
        $med1 = Medication::find($med->medication_id);
        $this->assertEquals($med1->name, $med->name);
        $this->assertEquals($med1->dosage_amount, 50);
        $this->assertEquals($med1->dosage_unit, $med->dosage_unit);
        $this->assertEquals($med1->comments, null);
        $this->assertEquals($med1->stat, 0);
    }

    public function testUpdateStatNullOrEmpty()
    {
        $user = factory(User::class)->create();
        $med = factory(Medication::class)->create();
        $response = $this->actingAs($user)->put('/medications/' . $med->medication_id, [
            'name' => $med->name,
            'dosage_amount' => 50,
            'dosage_unit' => $med->dosage_unit,
            'instructions' => $med->instructions,
            'comments' => '',
        ]);
        $response->assertRedirect('/admin');
        $med1 = Medication::find($med->medication_id);
        $this->assertEquals($med1->name, $med->name);
        $this->assertEquals($med1->dosage_amount, 50);
        $this->assertEquals($med1->dosage_unit, $med->dosage_unit);
        $this->assertEquals($med1->comments, null);
        $this->assertEquals($med1->stat, 0);

        $med = factory(Medication::class)->create();
        $response = $this->actingAs($user)->put('/medications/' . $med->medication_id, [
            'name' => $med->name,
            'dosage_amount' => 50,
            'dosage_unit' => $med->dosage_unit,
            'instructions' => $med->instructions,
            'comments' => '',
            'stat' => null,
        ]);
        $response->assertRedirect('/admin');
        $med1 = Medication::find($med->medication_id);
        $this->assertEquals($med1->name, $med->name);
        $this->assertEquals($med1->dosage_amount, 50);
        $this->assertEquals($med1->dosage_unit, $med->dosage_unit);
        $this->assertEquals($med1->comments, null);
        $this->assertEquals($med1->stat, 0);

    }

    public function testDelete()
    {
        $user = factory(User::class)->create();
        $med = factory(Medication::class)->create();
        $response = $this->actingAs($user)->delete('/medications/' . $med->medication_id);
        $response->assertRedirect();
        $this->assertNull(Medication::find($med->medication_id));
    }

    public function testVerify()
    {
        $med = factory(Medication::class)->create();
        $response = $this->json('POST', '/api/v1/medications/verify', [
            'name' => $med->name,
            'dosage' => $med->dosage_amount,
            'units' => $med->dosage_unit,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'name' => $med->name,
                'dosage' => $med->dosage_amount,
                'units' => $med->dosage_unit,
                'instructions' => $med->instructions,
                'comments' => $med->comments,
                'stat' => $med->stat,
            ]
        ]);
    }

    public function testVerifyError()
    {
        $response = $this->json('POST', '/api/v1/medications/verify', [
            'name' => 'Wellbutrin',
            'dosage' => 10,
            'units' => 'mg',
        ]);
        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'data',
        ]);
        $response->assertJsonFragment(['status' => 'error']);
    }
}
