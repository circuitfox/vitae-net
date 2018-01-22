<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTableTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasOrdersTable()
    {
        $this->assertTrue(Schema::hasTable('orders'));
    }

    public function testHasIdColumn()
    {
        $this->assertTrue(Schema::hasColumn('orders', 'id'));
    }

    public function testHasNameColumn()
    {
        $this->assertTrue(Schema::hasColumn('orders', 'name'));
    }

    public function testHasDescriptionColumn()
    {
        $this->assertTrue(Schema::hasColumn('orders', 'description'));
    }

    public function testHasFilePathColumn()
    {
        $this->assertTrue(Schema::hasColumn('orders', 'file_path'));
    }

    public function testHasPatientIdColumn()
    {
        $this->assertTrue(Schema::hasColumn('orders', 'patient_id'));
    }

    public function testHasCompletedColumn()
    {
        $this->assertTrue(Schema::hasColumn('orders', 'completed'));
    }
}
