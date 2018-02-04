<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $user = factory(\App\User::class)->create();
        $this->assertNotNull($user);
    }
}
