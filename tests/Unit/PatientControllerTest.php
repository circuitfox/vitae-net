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
        $user = factory(User::class)->states('instructor')->create();
        $response = $this->actingAs($user)->get('/patients/create');
        $response->assertViewIs('admin.patients.create');
    }

    public function testCreateInstructorOrAdmin()
    {
        $user = factory(User::class)->states('student')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($user)->get('/patients/create');
        $response->assertStatus(403);
        $response = $this->actingAs($admin)->get('/patients/create');
        $response->assertViewIs('admin.patients.create');
        $response = $this->actingAs($instructor)->get('/patients/create');
        $response->assertViewIs('admin.patients.create');
    }

    public function testStore()
    {
        $user = factory(User::class)->states('instructor')->create();
        $response = $this->actingAs($user)->post('/patients', [
            'medical_record_number' => 1234,
            'first_name' => 'joe',
            'last_name' => 'smith',
            'date_of_birth' => '1/1/1990',
            'sex' => true,
            'physician' => 'dr. jones',
            'room' => '3a',
        ]);
        $response->assertRedirect('/home');
        $patient = Patient::find(1234);
        $this->assertNotNull($patient);
        $this->assertEquals($patient->medical_record_number, 1234);
        $this->assertEquals($patient->first_name, 'joe');
        $this->assertEquals($patient->last_name, 'smith');
        $this->assertEquals($patient->date_of_birth, '1/1/1990');
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
        $user = factory(User::class)->states('instructor')->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number . '/edit');
        $response->assertViewIs('admin.patient.edit');
    }

    public function testEditInstructorOrAdmin()
    {
        $user = factory(User::class)->states('student')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $admin = factory(User::class)->states('admin')->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number . '/edit');
        $response->assertStatus(403);
        $response = $this->actingAs($admin)->get('/patients/' . $patient->medical_record_number . '/edit');
        $response->assertViewIs('admin.patient.edit');
        $response = $this->actingAs($instructor)->get('/patients/' . $patient->medical_record_number . '/edit');
        $response->assertViewIs('admin.patient.edit');
    }

    public function testUpdate()
    {
        $user = factory(User::class)->states('instructor')->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->put('/patients/' . $patient->medical_record_number, [
            'first_name' => 'joe',
            'last_name' => 'smith',
            'date_of_birth' => $patient->date_of_birth,
            'sex' => $patient->sex,
            'physician' => $patient->physician,
            'room' => $patient->room,
        ]);
        $response->assertRedirect('/home');
        $patient1 = Patient::find($patient->medical_record_number);
        $this->assertEquals($patient1->first_name, 'joe');
        $this->assertEquals($patient1->last_name, 'smith');
        $this->assertEquals($patient1->date_of_birth, $patient->date_of_birth);
        $this->assertEquals($patient1->physician, $patient->physician);
        $this->assertEquals($patient1->room, $patient->room);
    }

    public function testDelete()
    {
        $user = factory(User::class)->states('instructor')->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->delete('/patients/' . $patient->medical_record_number);
        $this->assertNull(Patient::find($patient->medical_record_number));
    }

    public function testDeleteInstructorOrAdmin()
    {
        $user = factory(User::class)->states('student')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $admin = factory(User::class)->states('admin')->create();
        $patient = factory(Patient::class)->create();
        $patient1 = factory(Patient::class)->create();
        $response = $this->actingAs($user)->delete('/patients/' . $patient->medical_record_number);
        $response->assertStatus(403);
        $response = $this->actingAs($admin)->delete('/patients/' . $patient->medical_record_number);
        $this->assertNull(Patient::find($patient->medical_record_number));
        $response = $this->actingAs($instructor)->delete('/patients/' . $patient1->medical_record_number);
        $this->assertNull(Patient::find($patient1->medical_record_number));
    }

    public function testVerifyWithMRN()
    {
        $patient = factory(Patient::class)->create();
        $response = $this->json('POST', '/api/v1/patients/verify', [
            'first_name' => $patient->first_name,
            'last_name' => $patient->last_name,
            'date_of_birth' => $patient->date_of_birth,
            'medical_record_number' => $patient->medical_record_number,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'medical_record_number' => $patient->medical_record_number,
                'first_name' => $patient->first_name,
                'last_name' => $patient->last_name,
                'date_of_birth' => $patient->date_of_birth,
                'sex' => $patient->sex ? 'Male' : 'Female',
                'height' => $patient->height,
                'weight' => $patient->weight,
                'diagnosis' => $patient->diagnosis,
                'allergies' => $patient->allergies,
                'code_status' => $patient->code_status,
                'physician' => $patient->physician,
                'room' => $patient->room,
            ],
        ]);
    }

    public function testVerifyOnlyMRN()
    {
        $patient = factory(Patient::class)->create();
        $response = $this->json('POST', '/api/v1/patients/verify', [
            'medical_record_number' => $patient->medical_record_number,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'medical_record_number' => $patient->medical_record_number,
                'first_name' => $patient->first_name,
                'last_name' => $patient->last_name,
                'date_of_birth' => $patient->date_of_birth,
                'sex' => $patient->sex ? 'Male' : 'Female',
                'height' => $patient->height,
                'weight' => $patient->weight,
                'diagnosis' => $patient->diagnosis,
                'allergies' => $patient->allergies,
                'code_status' => $patient->code_status,
                'physician' => $patient->physician,
                'room' => $patient->room,
            ],
        ]);
    }

    public function testVerifyNoMRNHasError()
    {
        $patient = factory(Patient::class)->create();
        $response = $this->json('POST', '/api/v1/patients/verify', [
            'first_name' => $patient->first_name,
            'last_name' => $patient->last_name,
            'date_of_birth' => $patient->date_of_birth,
        ]);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonFragment(['status' => 'error']);
    }

    public function testVerifyError()
    {
        $response = $this->json('POST', '/api/v1/patients/verify', [
            'first_name' => 'joe',
            'last_name' => 'smith',
            'date_of_birth' => '1/1/1997',
            'medical_record_number' => '12345',
        ]);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonFragment(['status' => 'error']);
    }

    public function testVerifyV2()
    {
        $patient = factory(Patient::class)->create();
        $response = $this->json('POST', '/api/v2/patients/verify', [
            'medical_record_number' => $patient->medical_record_number,
        ]);
        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'medical_record_number' => $patient->medical_record_number,
                'first_name' => $patient->first_name,
                'last_name' => $patient->last_name,
                'date_of_birth' => $patient->date_of_birth,
                'sex' => $patient->sex ? 'Male' : 'Female',
                'height' => $patient->height,
                'weight' => $patient->weight,
                'diagnosis' => $patient->diagnosis,
                'allergies' => $patient->allergies,
                'code_status' => $patient->code_status,
                'physician' => $patient->physician,
                'room' => $patient->room,
            ],
        ]);
    }

    public function testVerifyV2Error()
    {
        $response = $this->json('POST', '/api/v2/patients/verify', [
            'medical_record_number' => '12345',
        ]);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonFragment(['status' => 'error']);
    }
}
