<?php

namespace Tests\Feature\Model;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssessmentModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $assessment = factory(\App\Assessment::class)->create();
        $this->assertNotNull($assessment);
    }
}
