<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;

class CreateMarEntriesTableTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasMarEntriesTable()
    {
        $this->assertTrue(Schema::hasTable('mar_entries'));
    }

    public function testHasId()
    {
        $this->assertTrue(Schema::hasColumn('mar_entries', 'id'));
    }

    public function testHasMedicationIdColumn()
    {
        $this->assertTrue(Schema::hasColumn('mar_entries', 'medication_id'));
    }

    public function testHasMedicalRecordNumberColumn()
    {
        $this->assertTrue(Schema::hasColumn('mar_entries', 'medical_record_number'));
    }

    public function testHasStatColumn()
    {
        $this->assertTrue(Schema::hasColumn('mar_entries', 'stat'));
    }

    public function testHasInstructionsColumn()
    {
        $this->assertTrue(Schema::hasColumn('mar_entries', 'instructions'));
    }

    public function testHasGivenAtColumn()
    {
        $this->assertTrue(Schema::hasColumn('mar_entries', 'given_at'));
    }
}
