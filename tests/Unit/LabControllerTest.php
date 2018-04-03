<?php

namespace Tests\Unit;

use App\Lab;
use App\Patient;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class LabControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/labs');
        $response->assertViewIs('admin.labs');
    }

    public function testCreate()
    {
        $admin = factory(User::class)->states('admin')->create();
        $response = $this->actingAs($admin)->get('/labs/create');
        $response->assertViewIs('admin.labs.create');
    }

    public function testCreateInstructorOrAdmin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $student = factory(User::class)->states('student')->create();
        $response = $this->actingAs($admin)->get('/labs/create');
        $response->assertViewIs('admin.labs.create');
        $response = $this->actingAs($instructor)->get('/labs/create');
        $response->assertViewIs('admin.labs.create');
        $response = $this->actingAs($student)->get('/labs/create');
        $response->assertStatus(403);
    }

    public function testStore()
    {
        $user = factory(User::class)->states('admin')->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($user)->post('/labs', [
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient->medical_record_number,
            'doc' => UploadedFile::fake()->create('test.pdf'),
        ]);
        $response->assertRedirect();
        $lab = Lab::where([
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient->medical_record_number
        ])->first();
        $this->assertNotNull($lab);
        $this->assertEquals($lab->name, 'test');
        $this->assertEquals($lab->description, 'description');
        $this->assertEquals($lab->patient_id, $patient->medical_record_number);
        $this->assertNotNull($lab->patient());
        $this->assertEquals($lab->patient->medical_record_number, $patient->medical_record_number);
    }

    public function testStoreInstructorOrAdmin()
    {
        $user = factory(User::class)->states('student')->create();
        $admin = factory(User::class)->states('admin')->create();
        $patient = factory(Patient::class)->create();
        $patient1 = factory(Patient::class)->create();
        $response = $this->actingAs($admin)->post('/labs', [
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient->medical_record_number,
            'doc' => UploadedFile::fake()->create('test.pdf'),
        ]);
        $response->assertRedirect();
        $lab = Lab::where([
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient->medical_record_number,
        ])->first();
        $this->assertNotNull($lab);
        $this->assertEquals($lab->name, 'test');
        $this->assertEquals($lab->description, 'description');
        $this->assertEquals($lab->patient_id, $patient->medical_record_number);
        $this->assertNotNull($lab->patient());
        $this->assertEquals($lab->patient->medical_record_number, $patient->medical_record_number);
        $response = $this->actingAs($user)->post('/labs', [
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient1->medical_record_number,
            'doc' => UploadedFile::fake()->create('test.pdf'),
        ]);
        $response->assertStatus(403);
        $lab = Lab::where([
            'name' => 'test',
            'description' => 'description',
            'patient_id' => $patient1->medical_record_number
        ])->first();
        $this->assertNull($lab);
    }

    public function testShow()
    {
        $admin = factory(User::class)->states('admin')->create();
        $lab = factory(Lab::class)->create();
        $response = $this->actingAs($admin)->get('/labs/' . $lab->id);
        $response->assertViewIs('admin.lab');
    }

    public function testEdit()
    {
        $admin = factory(User::class)->states('admin')->create();
        $lab = factory(Lab::class)->create();
        $response = $this->actingAs($admin)->get('/labs/' . $lab->id . '/edit');
        $response->assertViewIs('admin.lab.edit');
    }

    public function testEditInstructorOrAdmin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $student = factory(User::class)->states('student')->create();
        $lab = factory(Lab::class)->create();
        $response = $this->actingAs($admin)->get('/labs/' . $lab->id . '/edit');
        $response->assertViewIs('admin.lab.edit');
        $response = $this->actingAs($instructor)->get('/labs/' . $lab->id . '/edit');
        $response->assertViewIs('admin.lab.edit');
        $response = $this->actingAs($student)->get('/labs/' . $lab->id . '/edit');
        $response->assertStatus(403);
    }

    public function testUpdate()
    {
        $admin = factory(User::class)->states('admin')->create();
        $lab = factory(Lab::class)->create();
        $response = $this->actingAs($admin)->put('/labs/' . $lab->id, [
            'name' => 'foo',
            'description' => $lab->description,
            'patient_id' => $lab->patient_id,
        ]);
        $lab1 = Lab::find($lab->id);
        $this->assertNotNull($lab1);
        $this->assertEquals($lab1->name, 'foo');
        $this->assertEquals($lab1->description, $lab->description);
        $this->assertEquals($lab1->patient_id, $lab->patient_id);
        $this->assertNotNull($lab1->patient());
        $this->assertEquals($lab1->patient->medical_record_number, $lab->patient->medical_record_number);
    }

    public function testUpdatePatient()
    {
        $admin = factory(User::class)->states('admin')->create();
        $lab = factory(Lab::class)->create();
        $patient = factory(Patient::class)->create();
        $response = $this->actingAs($admin)->put('/labs/' . $lab->id, [
            'description' => $lab->description,
            'name' => $lab->name,
            'patient_id' => $patient->medical_record_number,
        ]);
        $lab1 = Lab::find($lab->id);
        $this->assertNotNull($lab1);
        $this->assertEquals($lab1->name, $lab->name);
        $this->assertEquals($lab1->description, $lab->description);
        $this->assertNotEquals($lab1->patient_id, $lab->patient_id);
        $this->assertEquals($lab1->patient_id, $patient->medical_record_number);
        $this->assertNotNull($lab1->patient);
        $this->assertNotEquals($lab1->patient, $lab->patient);
        $this->assertNotEquals($lab1->patient->medical_record_number, $lab->patient->medical_record_number);
        $this->assertEquals($lab1->patient->medical_record_number, $patient->medical_record_number);
    }

    public function testUpdateFile()
    {
        $admin = factory(User::class)->states('admin')->create();
        $lab = factory(Lab::class)->create();
        $response = $this->actingAs($admin)->put('/labs/' . $lab->id, [
            'name' => 'foo',
            'description' => $lab->description,
            'doc' => UploadedFile::fake()->create('test.pdf'),
            'patient_id' => $lab->patient_id,
        ]);
        $lab1 = Lab::find($lab->id);
        $this->assertNotNull($lab1);
        $this->assertEquals($lab1->name, 'foo');
        $this->assertEquals($lab1->description, $lab->description);
        $this->assertEquals($lab1->file_path, $lab->file_path);
        $this->assertEquals($lab1->patient_id, $lab->patient_id);
        $this->assertNotNull($lab1->patient());
        $this->assertEquals($lab1->patient->medical_record_number, $lab->patient->medical_record_number);
    }

    public function testUpdateInstructorOrAdmin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $student = factory(User::class)->states('student')->create();
        $lab = factory(Lab::class)->create();
        $response = $this->actingAs($admin)->put('/labs/' . $lab->id, [
            'name' => 'foo',
            'description' => $lab->description,
            'patient_id' => $lab->patient_id,
        ]);
        $lab1 = Lab::find($lab->id);
        $this->assertNotNull($lab1);
        $this->assertEquals($lab1->name, 'foo');
        $this->assertEquals($lab1->description, $lab->description);
        $this->assertEquals($lab1->patient_id, $lab->patient_id);
        $this->assertNotNull($lab1->patient());
        $this->assertEquals($lab1->patient->medical_record_number, $lab->patient->medical_record_number);
        $response = $this->actingAs($instructor)->put('/labs/' . $lab->id, [
            'name' => 'bar',
            'description' => $lab->description,
            'patient_id' => $lab->patient_id,
        ]);
        $lab1 = Lab::find($lab->id);
        $this->assertNotNull($lab1);
        $this->assertEquals($lab1->name, 'bar');
        $this->assertEquals($lab1->description, $lab->description);
        $this->assertEquals($lab1->patient_id, $lab->patient_id);
        $this->assertNotNull($lab1->patient());
        $this->assertEquals($lab1->patient->medical_record_number, $lab->patient->medical_record_number);
        $response = $this->actingAs($student)->put('/labs/' . $lab->id, [
            'name' => 'foo',
            'description' => $lab->description,
            'patient_id' => $lab->patient_id,
        ]);
        $response->assertStatus(403);
        $lab1 = Lab::find($lab->id);
        $this->assertNotNull($lab1);
        $this->assertEquals($lab1->name, 'bar');
        $this->assertEquals($lab1->description, $lab->description);
        $this->assertEquals($lab1->patient_id, $lab->patient_id);
        $this->assertNotNull($lab1->patient());
        $this->assertEquals($lab1->patient->medical_record_number, $lab->patient->medical_record_number);
    }

    public function testDelete()
    {
        $user = factory(User::class)->states('admin')->create();
        $lab = factory(Lab::class)->create();
        $response = $this->actingAs($user)->delete('/labs/' . $lab->id);
        $response->assertRedirect();
        $this->assertNull(Lab::find($lab->id));
    }

    public function testDeleteInstructorOrAdmin()
    {
        $user = factory(User::class)->states('student')->create();
        $admin = factory(User::class)->states('admin')->create();
        $instructor = factory(User::class)->states('instructor')->create();
        $lab = factory(Lab::class)->create();
        $lab1 = factory(Lab::class)->create();
        $response = $this->actingAs($admin)->delete('/labs/' . $lab->id);
        $response->assertRedirect();
        $this->assertNull(Lab::find($lab->id));
        $response = $this->actingAs($user)->delete('/labs/' . $lab1->id);
        $response->assertStatus(403);
        $this->assertNotNull(Lab::find($lab1->id));
        $response = $this->actingAs($instructor)->delete('/labs/' . $lab1->id);
        $response->assertRedirect();
        $this->assertNull(Lab::find($lab1->id));
    }
}
