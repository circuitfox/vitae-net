<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;

class CreateSignaturesTableTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasSignaturesTable()
    {
        $this->assertTrue(Schema::hasTable('signatures'));
    }

    public function testHasIdColumn()
    {
        $this->assertTrue(Schema::hasColumn('signatures', 'id'));
    }

    public function testHasMedicationIdColumn()
    {
        $this->assertTrue(Schema::hasColumn('signatures', 'medication_id'));
    }

    public function testHasMedicalRecordNumberColumn()
    {
        $this->assertTrue(Schema::hasColumn('signatures', 'medical_record_number'));
    }

    public function testHasTimeColumn()
    {
        $this->assertTrue(Schema::hasColumn('signatures', 'time'));
    }

    public function testHasStudentNameColumn()
    {
        $this->assertTrue(Schema::hasColumn('signatures', 'student_name'));
    }
}
