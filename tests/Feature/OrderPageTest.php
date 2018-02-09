<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderPageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasOrder()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $order = factory(\App\Order::class)->create();
    $response = $this->actingAs($user)->get('/orders/' . $order->order_id);
    $response->assertSee('<h3>' . $order->name . '</h3>');
    $response->assertSee('<h5><b><u>Name:</u></b></h5>');
    $response->assertSee('<p>' . $order->name . '</p>');
    $response->assertSee('<h5><b><u>Description</u></b></h5>');
    $response->assertSee('<p>' . $order->description . '</p>');
    $response->assertSee('<h5><b><u>Patient MRN</u></b></h5>');
    $response->assertSee('<p>' . $order->patient_id . '</p>');
    $response->assertSee('<h5><b><u>Completed:</u></b></h5>');
    $response->assertSee('<p>' . $order->completed ? 'Yes': 'No' '</p>');
  }
}
