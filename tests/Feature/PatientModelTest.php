<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PatientModelTest extends TestCase
{
    use DatabaseMigrations;

    public function testFactory()
    {
        $patient = factory(\App\Patient::class)->create();
        $this->assertNotNull($patient);
    }
}
