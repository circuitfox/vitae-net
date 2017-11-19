<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MedicationModelTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testFactory()
    {
        $medication = factory(\App\Medication::class)->create();
        $this->assertNotNull($medication);
    }
}
