<?php

namespace Tests\Feature;

use App\MarEntry;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarEntryModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $mar_entry = factory(MarEntry::class)->create();
        $this->assertNotNull($mar_entry);
        $this->assertNotNull($mar_entry->patient());
        $this->assertNotNull($mar_entry->medication());
    }

    public function testTimesToInteger()
    {
        // 0x1023 - 0b1_0000_0010_0011
        $times = [1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1];
        $times_int = MarEntry::timesToInteger($times);
        $this->assertEquals(0x1023, $times_int);
        // 0x0000
        $times = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $times_int = MarEntry::timesToInteger($times);
        $this->assertEquals(0x0, $times_int);
        // 0x1fff
        $times = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];
        $times_int = MarEntry::timesToInteger($times);
        $this->assertEquals(0x1fff, $times_int);
        // empty
        $times_int = MarEntry::timesToInteger([]);
        $this->assertEquals(0, $times_int);
        // some null values in the array
        $times = [
            0 => 1,
            1 => 1,
            5 => 1,
            12 => 1,
        ];
        $times_int = MarEntry::timesToInteger($times);
        $this->assertEquals(0x1023, $times_int);
    }

    public function testTimesToIntegerBooleanArray()
    {
        // 0x1023 - 0b1_0000_0010_0011
        $times = [true, true, false, false, false, true, false, false, false, false, false, false, true];
        $times_int = MarEntry::timesToInteger($times);
        $this->assertEquals(0x1023, $times_int);
        // 0x0000
        $times = [false, false, false, false, false, false, false, false, false, false, false, false, false];
        $times_int = MarEntry::timesToInteger($times);
        $this->assertEquals(0x0, $times_int);
        // 0x1fff
        $times = [true, true, true, true, true, true, true, true, true, true, true, true, true];
        $times_int = MarEntry::timesToInteger($times);
        $this->assertEquals(0x1fff, $times_int);
        // empty
        $times_int = MarEntry::timesToInteger([]);
        $this->assertEquals(0, $times_int);
        // some null values in the array
        $times = [
            0 => true,
            1 => true,
            5 => true,
            12 => true,
        ];
        $times_int = MarEntry::timesToInteger($times);
        $this->assertEquals(0x1023, $times_int);
    }

    public function testTimesFromInteger()
    {
        $mar_entry = factory(MarEntry::class)->create([
            'given_at' => 0x1023,
        ]);
        $times = $mar_entry->timesFromInteger();
        $this->assertEquals([1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1], $times);
        $mar_entry = factory(MarEntry::class)->create([
            'given_at' => 0x0,
        ]);
        $times = $mar_entry->timesFromInteger();
        $this->assertEquals([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], $times);
        $mar_entry = factory(MarEntry::class)->create([
            'given_at' => 0x1fff,
        ]);
        $times = $mar_entry->timesFromInteger();
        $this->assertEquals([1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], $times);
    }
}
