<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicationModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $medication = factory(\App\Medication::class)->create();
        $this->assertNotNull($medication);
    }

    public function testToApiArrayV2()
    {
        $medication = factory(\App\Medication::class)->create();
        $arr = $medication->toApiArrayV2();
        $this->assertEquals($arr['name'], $medication->primaryName());
        $this->assertEquals($arr['secondary_name'], '');
        $this->assertEquals($arr['dosage_amount'], $medication->dosage_amount);
        $this->assertEquals($arr['dosage_unit'], $medication->dosage_unit);
        $this->assertEquals($arr['second_amount'], $medication->second_amount);
        $this->assertEquals($arr['second_unit'], $medication->second_unit);
        $this->assertEquals($arr['second_type'], $medication->second_type);
        $this->assertEquals($arr['comments'], $medication->comments);
    }

    public function testToApiArrayV2WithSecondaryName()
    {
        $medication = factory(\App\Medication::class)->states(['secondary_name'])->create();
        $arr = $medication->toApiArrayV2();
        $this->assertEquals($arr['name'], $medication->primaryName());
        $this->assertEquals($arr['secondary_name'], $medication->secondaryName());
        $this->assertEquals($arr['dosage_amount'], $medication->dosage_amount);
        $this->assertEquals($arr['dosage_unit'], $medication->dosage_unit);
        $this->assertEquals($arr['second_amount'], $medication->second_amount);
        $this->assertEquals($arr['second_unit'], $medication->second_unit);
        $this->assertEquals($arr['second_type'], $medication->second_type);
        $this->assertEquals($arr['comments'], $medication->comments);
    }

    public function testPrimaryName()
    {
        $medication = factory(\App\Medication::class)->create();
        $medication1 = factory(\App\Medication::class)->states(['secondary_name'])->create();
        $this->assertNotEquals('', $medication->primaryName());
        $this->assertNotEquals('', $medication1->primaryName());
    }

    public function testSecondaryName()
    {
        $medication = factory(\App\Medication::class)->create();
        $medication1 = factory(\App\Medication::class)->states(['secondary_name'])->create();
        $this->assertEquals('', $medication->secondaryName());
        $this->assertNotEquals('', $medication1->secondaryName());
    }
}
