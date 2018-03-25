<?php

namespace Tests\Feature\Model;

use App\Assessment;
use App\Patient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class AssessmentModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $assessment = factory(Assessment::class)->create();
        $this->assertNotNull($assessment);
    }

    public function testByDate()
    {
        $patient = factory(Patient::class)->create();
        $assessments = factory(Assessment::class, 5)
            ->create()
            ->each(function($assessment) use ($patient) {
                $assessment->medical_record_number = $patient->medical_record_number;
                $assessment->update();
            });
        $lastDate = null;
        foreach (Assessment::byDate($patient) as $date => $assessment) {
            if ($lastDate === null) {
                $lastDate = $date;
            } else {
                $this->assertTrue($lastDate >= $date);
                $lastDate = $date;
            }
        }
    }
}
