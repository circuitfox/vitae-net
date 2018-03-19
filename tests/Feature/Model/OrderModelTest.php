<?php

namespace Tests\Feature\Model;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersModelTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $order = factory(\App\Order::class)->create();
        $this->assertNotNull($order);
        $this->assertNotNull($order->patient());
    }
}
