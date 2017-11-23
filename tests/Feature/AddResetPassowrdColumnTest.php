<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;

class AddResetPasswordColumnTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasResetPasswordColumn()
    {
        $this->assertTrue(Schema::hasColumn('users', 'reset_password'));
    }
}
