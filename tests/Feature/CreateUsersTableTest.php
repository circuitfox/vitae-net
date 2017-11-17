<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;

class CreateUsersTableTest extends TestCase
{
  use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHasUsersTable()
    {
        $this->assertTrue(Schema::hasTable("users"));
    }

    public function testHasIdColumn(){
      $this->assertTrue(Schema::hasColumn("users", "id"));
    }

    public function testHasNameColumn(){
      $this->assertTrue(Schema::hasColumn("users", "name"));
    }

    public function testHasEmailColumn(){
      $this->assertTrue(Schema::hasColumn("users", "email"));
    }

    public function testHasPasswordColumn(){
      $this->assertTrue(Schema::hasColumn("users", "password"));
    }

    public function testHasRoleColumn(){
      $this->assertTrue(Schema::hasColumn("users", "role"));
    }
}
