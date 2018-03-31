<?php

namespace Tests\Unit;

use App\Medication;
use App\Patient;
use App\Signature;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignatureControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $user = factory(User::class)->states('student')->create();
        $response = $this->actingAs($admin)->get('/signatures');
        $response->assertViewIs('admin.signatures');
        $response = $this->actingAs($instructor)->get('/signatures');
        $response->assertViewIs('admin.signatures');
        $response = $this->actingAs($user)->get('/signatures');
        $response->assertStatus(403);
    }

    public function testStore()
    {
        $admin = factory(User::class)->states('admin')->create();
        $medication = factory(Medication::class)->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($admin)->post('/scan', [
            'student_name' => $admin->name,
            'time' => '8:00 AM',
            'medical_record_number' => $patient->medical_record_number,
            'medications' => [[
                'medication_id' => $medication->medication_id,
            ]],
        ]);
        $response->assertRedirect();
        $signature = Signature::where([
            'student_name' => $admin->name,
            'time' => '8:00 AM',
            'medical_record_number' => $patient->medical_record_number,
            'medication_id' => $medication->medication_id,
        ])->first();
        $this->assertNotNull($signature);
        $this->assertNotNull($signature->patient);
        $this->assertNotNull($signature->medication);
        $this->assertEquals($admin->name, $signature->student_name);
        $this->assertEquals('8:00 AM', $signature->time);
        $this->assertEquals($patient->medical_record_number, $signature->patient->medical_record_number);
        $this->assertEquals($medication->medication_id, $signature->medication->medication_id);
    }

    public function testStoreMultiple()
    {
        $admin = factory(User::class)->states('admin')->create();
        $medications = factory(Medication::class, 2)->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($admin)->post('/scan', [
            'student_name' => $admin->name,
            'time' => '8:00 AM',
            'medical_record_number' => $patient->medical_record_number,
            'medications' => [[
                'medication_id' => $medications[0]->medication_id,
            ],
            [
                'medication_id' => $medications[1]->medication_id,
            ]],
        ]);
        $response->assertRedirect();
        $signature = Signature::where([
            'student_name' => $admin->name,
            'time' => '8:00 AM',
            'medical_record_number' => $patient->medical_record_number,
            'medication_id' => $medications[0]->medication_id,
        ])->first();
        $this->assertNotNull($signature);
        $this->assertNotNull($signature->patient);
        $this->assertNotNull($signature->medication);
        $this->assertEquals($admin->name, $signature->student_name);
        $this->assertEquals('8:00 AM', $signature->time);
        $this->assertEquals($patient->medical_record_number, $signature->patient->medical_record_number);
        $this->assertEquals($medications[0]->medication_id, $signature->medication->medication_id);

        $signature = Signature::where([
            'student_name' => $admin->name,
            'time' => '8:00 AM',
            'medical_record_number' => $patient->medical_record_number,
            'medication_id' => $medications[1]->medication_id,
        ])->first();
        $this->assertNotNull($signature);
        $this->assertNotNull($signature->patient);
        $this->assertNotNull($signature->medication);
        $this->assertEquals($admin->name, $signature->student_name);
        $this->assertEquals('8:00 AM', $signature->time);
        $this->assertEquals($patient->medical_record_number, $signature->patient->medical_record_number);
        $this->assertEquals($medications[1]->medication_id, $signature->medication->medication_id);
    }

    public function testDelete()
    {
        $admin = factory(User::class)->states('admin')->create();
        $signature = factory(Signature::class)->create();
        $response = $this->actingAs($admin)->post('/signatures/delete', [
            'ids' => [
                $signature->id
            ]
        ]);
        $response->assertRedirect();
        $signature = Signature::find($signature->id);
        $this->assertNull($signature);
    }

    public function testDeleteEmpty()
    {
        $admin = factory(User::class)->states('admin')->create();
        $signature = factory(Signature::class)->create();
        $response = $this->actingAs($admin)->post('/signatures/delete', [
        ]);
        $response->assertRedirect();
        $signature = Signature::find($signature->id);
        $this->assertNotNull($signature);
    }

    public function testDeleteInstructorOrAdmin()
    {
        $instructor = factory(User::class)->states('instructor')->create();
        $user = factory(User::class)->states('student')->create();
        $signature = factory(Signature::class)->create();
        $response = $this->actingAs($user)->post('/signatures/delete', [
            'ids' => [
                $signature->id
            ]
        ]);
        $response->assertStatus(403);
        $signature = Signature::find($signature->id);
        $this->assertNotNull($signature);
        $response = $this->actingAs($instructor)->post('/signatures/delete', [
            'ids' => [
                $signature->id
            ]
        ]);
        $response->assertRedirect();
        $signature = Signature::find($signature->id);
        $this->assertNull($signature);
    }

    public function testDeleteMultiple()
    {
        $admin = factory(User::class)->states('admin')->create();
        $signatures = factory(Signature::class, 2)->create();
        $response = $this->actingAs($admin)->post('/signatures/delete', [
            'ids' => [
                $signatures[0]->id,
                $signatures[1]->id
            ]
        ]);
        $response->assertRedirect();
        $signature = Signature::find($signatures[0]->id);
        $this->assertNull($signature);
        $signature = Signature::find($signatures[1]->id);
        $this->assertNull($signature);
    }
}
