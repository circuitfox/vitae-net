<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;

class CreateLabsTableTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasLabsTable()
    {
        $this->assertTrue(Schema::hasTable('labs'));
    }

    public function testHasIdColumn()
    {
        $this->assertTrue(Schema::hasColumn('labs', 'id'));
    }

    public function testHasNameColumn()
    {
        $this->assertTrue(Schema::hasColumn('labs', 'name'));
    }

    public function testHasDescriptionColumn()
    {
        $this->assertTrue(Schema::hasColumn('labs', 'description'));
    }

    public function testHasFilePathColumn()
    {
        $this->assertTrue(Schema::hasColumn('labs', 'file_path'));
    }

    public function testHasPatientIdColumn()
    {
        $this->assertTrue(Schema::hasColumn('labs', 'patient_id'));
    }
}
