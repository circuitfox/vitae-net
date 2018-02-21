<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarEntryModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $mar_entry = factory(\App\MarEntry::class)->create();
        $this->assertNotNull($mar_entry);
        $this->assertNotNull($mar_entry->patient());
        $this->assertNotNull($mar_entry->medication());
    }
}
