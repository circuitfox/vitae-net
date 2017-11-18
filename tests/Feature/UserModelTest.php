<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserModelTest extends TestCase
{
    use DatabaseMigrations;

    public function testFactory()
    {
        $user = factory(\App\User::class)->create();
        $this->assertNotNull($user);
    }
}
