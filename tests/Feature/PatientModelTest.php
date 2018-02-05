<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $patient = factory(\App\Patient::class)->create();
        $this->assertNotNull($patient);
    }
}
