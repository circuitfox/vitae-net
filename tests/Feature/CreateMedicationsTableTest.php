<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTableTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasMedicationsTable()
    {
        $this->assertTrue(Schema::hasTable("medications"));
    }

    public function testHasMedicationIdColumn()
    {
        $this->assertTrue(Schema::hasColumn("medications", "medication_id"));
    }

    public function testHasNameColumn()
    {
        $this->assertTrue(Schema::hasColumn("medications", "name"));
    }

    public function testHasDosageAmountColumn()
    {
        $this->assertTrue(Schema::hasColumn("medications", "dosage_amount"));
    }

    public function testHasDosageUnitColumn()
    {
        $this->assertTrue(Schema::hasColumn("medications", "dosage_unit"));
    }

    public function testHasInstructionsColumn()
    {
        $this->assertTrue(Schema::hasColumn("medications", "instructions"));
    }

    public function testHasCommentsColumn()
    {
        $this->assertTrue(Schema::hasColumn("medications", "comments"));
    }

    public function testHasStatColumn()
    {
        $this->assertTrue(Schema::hasColumn("medications", "stat"));
    }
}
