<?php

namespace Tests\Feature\Model;

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
        $primary_amount = $medication->dosage_amount;
        $this->assertEquals(
            "{$medication->name} {$primary_amount} {$medication->dosage_unit}",
            $medication->toString()
        );
    }

    public function testToStringCombo()
    {
        $comboMedication = factory(\App\Medication::class)
            ->states(['secondary_name', 'combo'])
            ->create();
        $primary_amount = $comboMedication->dosage_amount;
        $secondary_amount = $comboMedication->second_amount;
        $this->assertEquals(
            $comboMedication->primaryName()
            . " {$primary_amount} {$comboMedication->dosage_unit} / "
            . $comboMedication->secondaryName()
            . " {$secondary_amount} {$comboMedication->second_unit}",
            $comboMedication->toString()
        );
    }

    public function testToStringAmount()
    {
        $amountMedication = factory(\App\Medication::class)
            ->states(['secondary_name', 'amount'])
            ->create();
        $primary_amount = $amountMedication->dosage_amount;
        $secondary_amount = $amountMedication->second_amount;
        $this->assertEquals(
            $amountMedication->primaryName()
            . " {$primary_amount} {$amountMedication->dosage_unit} with "
            . "{$secondary_amount} {$amountMedication->second_unit}",
            $amountMedication->toString()
        );
    }

    public function testToStringIn()
    {
        $inMedication = factory(\App\Medication::class)
            ->states(['secondary_name', 'in'])
            ->create();
        $primary_amount = $inMedication->dosage_amount;
        $secondary_amount = $inMedication->second_amount;
        $this->assertEquals(
            $inMedication->primaryName()
            . " {$primary_amount} {$inMedication->dosage_unit} in "
            . $inMedication->secondaryName()
            . " {$secondary_amount} {$inMedication->second_unit}",
            $inMedication->toString()
        );
    }

    public function testToMarArray()
    {
        $medication = factory(\App\Medication::class)->create();
        $marArray = ['name' => $medication->toString(), 'id' => $medication->medication_id];
        $this->assertEquals($marArray, $medication->toMarArray());
    }
}
