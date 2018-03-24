<?php

namespace Tests\Unit;

use App\Assessment;
use App\Patient;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class AssessmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = factory(User::class)->states('admin')->create();
        $assessment = factory(Assessment::class)->create();
        $response = $this->actingAs($user)->get('/assessments/' . $assessment->medical_record_number);
        $response->assertViewIs('admin.assessments');
        // make sure the data is correctly formatted
        $content = $response->getOriginalContent();
        $date = Carbon::parse($assessment->date)->toFormattedDateString();
        $this->assertEquals($assessment->toArray(), $content->getData()['assessments'][$date][0]);
    }

    public function testIndexInstructorOrAdmin()
    {
        $user = factory(User::class)->states('instructor')->create();
        $assessment = factory(Assessment::class)->create();
        $response = $this->actingAs($user)->get('/assessments/' . $assessment->medical_record_number);
        $response->assertViewIs('admin.assessments');
        $user = factory(User::class)->states('student')->create();
        $response = $this->actingAs($user)->get('/assessments/' . $assessment->medical_record_number);
        $response->assertStatus(403);
    }

    public function testCreate()
    {
        $user = factory(User::class)->states('admin')->create();
        $patient = factory(Patient::class)->create();
        $this->assertNull(session('assessment'));
        $response = $this->actingAs($user)->post('/assessments/update', [
            'student_name' => 'Joe Smith',
            'date' => '2018-01-01',
            'start_time' => '11:00',
            'end_time' => '12:00',
            'medical_record_number' => $patient->medical_record_number,
            'reason' => 'test',
            'temperature' => 98,
            'bp_over' => 100,
            'bp_under' => 100,
            'apical_pulse' => 60,
            'respiration' => 60,
            'oximetry' => 120,
            'automatic' => true,
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('assessment');
        $assessment = Assessment::find(session('assessment'));
        $this->assertNotNull($assessment);
        $this->assertNotNull($assessment->patient);
        $this->assertEquals('Joe Smith', $assessment->student_name);
        $this->assertEquals('2018-01-01', $assessment->date);
        $this->assertEquals('11:00', $assessment->start_time);
        $this->assertEquals('12:00', $assessment->end_time);
        $this->assertEquals($patient->medical_record_number, $assessment->medical_record_number);
        $this->assertEquals('test', $assessment->reason);
        $this->assertEquals(98, $assessment->temperature);
        $this->assertEquals(100, $assessment->bp_over);
        $this->assertEquals(100, $assessment->bp_under);
        $this->assertEquals(60, $assessment->apical_pulse);
        $this->assertEquals(60, $assessment->respiration);
        $this->assertEquals(120, $assessment->oximetry);
        $this->assertEquals(1, $assessment->automatic);
    }

    public function testCreateThenUpdate()
    {
        $user = factory(User::class)->states('admin')->create();
        $patient = factory(Patient::class)->create();
        $this->assertNull(session('assessment'));
        $response = $this->actingAs($user)->post('/assessments/update/', [
            'student_name' => 'Joe Smith',
            'date' => '2018-01-01',
            'start_time' => '11:00',
            'end_time' => '12:00',
            'medical_record_number' => $patient->medical_record_number,
            'reason' => 'test',
            'temperature' => 98,
            'bp_over' => 100,
            'bp_under' => 100,
            'apical_pulse' => 60,
            'respiration' => 60,
            'oximetry' => 120,
            'automatic' => true,
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('assessment');
        $assessment = Assessment::find(session('assessment'));
        $this->assertNotNull($assessment);
        $this->assertNotNull($assessment->patient);
        $this->assertEquals('Joe Smith', $assessment->student_name);
        $this->assertEquals('2018-01-01', $assessment->date);
        $this->assertEquals('11:00', $assessment->start_time);
        $this->assertEquals('12:00', $assessment->end_time);
        $this->assertEquals($patient->medical_record_number, $assessment->medical_record_number);
        $this->assertEquals('test', $assessment->reason);
        $this->assertEquals(98, $assessment->temperature);
        $this->assertEquals(100, $assessment->bp_over);
        $this->assertEquals(100, $assessment->bp_under);
        $this->assertEquals(60, $assessment->apical_pulse);
        $this->assertEquals(60, $assessment->respiration);
        $this->assertEquals(120, $assessment->oximetry);
        $this->assertEquals(1, $assessment->automatic);

        $response = $this->actingAs($user)->post('/assessments/update/', [
            'student_name' => 'Joe Smith',
            'date' => '2018-01-01',
            'start_time' => '10:30',
            'end_time' => '12:00',
            'medical_record_number' => $patient->medical_record_number,
            'reason' => 'test',
            'temperature' => 98,
            'bp_over' => 100,
            'bp_under' => 100,
            'apical_pulse' => 60,
            'respiration' => 60,
            'oximetry' => 120,
            'automatic' => true,
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('assessment');
        $assessment1 = Assessment::find(session('assessment'));
        $this->assertNotNull($assessment);
        $this->assertNotNull($assessment->patient);
        $this->assertEquals($assessment->student_name, $assessment1->student_name);
        $this->assertEquals($assessment->date, $assessment1->date);
        $this->assertEquals('10:30', $assessment1->start_time);
        $this->assertEquals($assessment->end_time, $assessment1->end_time);
        $this->assertEquals($assessment->medical_record_number, $assessment1->medical_record_number);
        $this->assertEquals($assessment->reason, $assessment1->reason);
        $this->assertEquals($assessment->temperature, $assessment1->temperature);
        $this->assertEquals($assessment->bp_over, $assessment1->bp_over);
        $this->assertEquals($assessment->bp_under, $assessment1->bp_under);
        $this->assertEquals($assessment->apical_pulse, $assessment1->apical_pulse);
        $this->assertEquals($assessment->respiration, $assessment1->respiration);
        $this->assertEquals($assessment->oximetry, $assessment1->oximetry);
        $this->assertEquals($assessment->automatic, $assessment1->automatic);
    }
}
