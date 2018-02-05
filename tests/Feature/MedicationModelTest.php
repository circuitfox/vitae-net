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

    public function testToApiArray()
    {
        $medication = factory(\App\Medication::class)->create();
        $arr = $medication->toApiArray();
        $this->assertEquals($arr['name'], $medication->primaryName());
        $this->assertEquals($arr['secondary_name'], '');
        $this->assertEquals($arr['dosage_amount'], $medication->dosage_amount);
        $this->assertEquals($arr['dosage_unit'], $medication->dosage_unit);
        $this->assertEquals($arr['second_amount'], $medication->second_amount);
        $this->assertEquals($arr['second_unit'], $medication->second_unit);
        $this->assertEquals($arr['second_type'], $medication->second_type);
        $this->assertEquals($arr['comments'], $medication->comments);
    }

    public function testToApiArrayWithSecondaryName()
    {
        $medication = factory(\App\Medication::class)->states(['secondary_name'])->create();
        $arr = $medication->toApiArray();
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
        $this->assertTrue(empty($medication->secondaryName()));
        $this->assertFalse(empty($medication1->secondaryName()));
    }

    public function testSecondaryName()
    {
        $medication = factory(\App\Medication::class)->create();
        $medication1 = factory(\App\Medication::class)->states(['secondary_name'])->create();
        $this->assertTrue(empty($medication->secondaryName()));
        $this->assertFalse(empty($medication1->secondaryName()));
    }

    public function testToString()
    {
        $medication = factory(\App\Medication::class)->states(['no_secondary'])->create();
        $this->assertEquals(
            "{$medication->name} {$medication->dosage_amount} {$medication->dosage_unit}",
            $medication->toString()
        );
    }

    public function testToStringCombo()
    {
        $comboMedication = factory(\App\Medication::class)
            ->states(['secondary_name', 'combo'])
            ->create();
        $this->assertEquals(
            $comboMedication->primaryName()
            . " {$comboMedication->dosage_amount} {$comboMedication->dosage_unit} / "
            . $comboMedication->secondaryName()
            . " {$comboMedication->second_amount} {$comboMedication->second_unit}",
            $comboMedication->toString()
        );
    }

    public function testToStringAmount()
    {
        $amountMedication = factory(\App\Medication::class)
            ->states(['secondary_name', 'amount'])
            ->create();
        $this->assertEquals(
            $amountMedication->primaryName()
            . " {$amountMedication->dosage_amount} {$amountMedication->dosage_unit} with "
            . "{$amountMedication->second_amount} {$amountMedication->second_unit}",
            $amountMedication->toString()
        );
    }

    public function testToStringIn()
    {
        $inMedication = factory(\App\Medication::class)
            ->states(['secondary_name', 'in'])
            ->create();
        $this->assertEquals(
            $inMedication->primaryName()
            . " {$inMedication->dosage_amount} {$inMedication->dosage_unit} in "
            . $inMedication->secondaryName()
            . " {$inMedication->second_amount} {$inMedication->second_unit}",
            $inMedication->toString()
        );
    }
}
