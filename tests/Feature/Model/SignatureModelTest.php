<?php

namespace Tests\Feature\Model;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignatureModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $signature = factory(\App\Signature::class)->create();
        $this->assertNotNull($signature);
        $this->assertNotNull($signature->patient());
        $this->assertNotNull($signature->medication());
    }
}
