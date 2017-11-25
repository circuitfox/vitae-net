<?php

namespace Tests\Unit;

use App\Patient;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/patients');
        $response->assertViewIs('admin.patients');
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/patients/create');
        $response->assertViewIs('admin.patients.create');
    }

    public function testStore()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/patients', [
            'medical_record_number' => 1234,
            'first_name' => 'joe',
            'last_name' => 'smith',
            'date_of_birth' => '1/1/1990',
            'sex' => true,
            'physician' => 'dr. jones',
            'room' => '3a',
        ]);
        $response->assertRedirect('/admin');
        $patient = Patient::find(1234);
        $this->assertNotNull($patient);
        $this->assertEquals($patient->medical_record_number, 1234);
        $this->assertEquals($patient->first_name, 'joe');
        $this->assertEquals($patient->last_name, 'smith');
        $this->assertEquals($patient->date_of_birth, '1990-01-01');
        $this->assertEquals($patient->sex, true);
        $this->assertEquals($patient->physician, 'dr. jones');
        $this->assertEquals($patient->room, '3a');
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number);
        $response->assertViewIs('admin.patient');
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number . '/edit');
        $response->assertViewIs('admin.patient.edit');
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->put('/patients/' . $patient->medical_record_number, [
            'first_name' => 'joe',
            'last_name' => 'smith',
            'date_of_birth' => $patient->date_of_birth,
            'sex' => $patient->sex,
            'physician' => $patient->physician,
            'room' => $patient->room,
        ]);
        $response->assertRedirect('/admin');
        $patient1 = Patient::find($patient->medical_record_number);
        $this->assertEquals($patient1->first_name, 'joe');
        $this->assertEquals($patient1->last_name, 'smith');
        $this->assertEquals($patient1->date_of_birth, $patient->date_of_birth);
        $this->assertEquals($patient1->physician, $patient->physician);
        $this->assertEquals($patient1->room, $patient->room);
    }

    public function testDelete()
    {
        $user = factory(User::class)->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->delete('/patients/' . $patient->medical_record_number);
        $this->assertNull(Patient::find($patient->medical_record_number));
    }

    public function testVerify()
    {
        $patient = factory(Patient::class)->create();
        $response = $this->json('POST', '/api/v1/patients/verify', [
            'first_name' => $patient->first_name,
            'last_name' => $patient->last_name,
            'dob' => $patient->date_of_birth,
            'mrn' => $patient->medical_record_number,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'mrn' => $patient->medical_record_number,
                'first_name' => $patient->first_name,
                'last_name' => $patient->last_name,
                'dob' => $patient->date_of_birth,
                'sex' => $patient->sex ? 'Male' : 'Female',
                'physician' => $patient->physician,
                'room' => $patient->room,
            ],
        ]);
    }

    public function testVerifyError()
    {
        $response = $this->json('POST', '/api/v1/patients/verify', [
            'first_name' => 'joe',
            'last_name' => 'smith',
            'dob' => '1/1/1997',
            'mrn' => '12345',
        ]);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonFragment(['status' => 'error']);
    }
}
