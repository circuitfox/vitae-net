<?php

namespace Tests\Feature\Table;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTableTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasPatientsTable()
    {
        $this->assertTrue(Schema::hasTable("patients"));
    }

    public function testHasMedicalRecordNumberColumn()
    {
        $this->assertTrue(Schema::hasColumn("patients", "medical_record_number"));
    }

    public function testHasLastNameColumn()
    {
        $this->assertTrue(Schema::hasColumn("patients", "last_name"));
    }

    public function testHasFirstNameColumn()
    {
        $this->assertTrue(Schema::hasColumn("patients", "first_name"));
    }

    public function testHasDateOfBirthColumn()
    {
        $this->assertTrue(Schema::hasColumn("patients", "date_of_birth"));
    }

    public function testHasSexColumn()
    {
        $this->assertTrue(Schema::hasColumn("patients", "sex"));
    }

    public function testHasPhysicianColumn()
    {
        $this->assertTrue(Schema::hasColumn("patients", "physician"));
    }

    public function testHasRoomColumn()
    {
        $this->assertTrue(Schema::hasColumn("patients", "room"));
    }
}
