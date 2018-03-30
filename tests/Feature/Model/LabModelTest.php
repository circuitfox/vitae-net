<?php

namespace Tests\Feature\Model;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabsModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $lab = factory(\App\Lab::class)->create();
        $this->assertNotNull($lab);
        $this->assertNotNull($lab->patient());
    }
}
