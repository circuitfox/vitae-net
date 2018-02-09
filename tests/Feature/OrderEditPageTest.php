<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderEditPageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasForm()
  {
    $user = factory(\App\User::class)->create();
    $order =factory(\App\Order::class)->create();
    $order->update();
    $response = $this->actingAs($user)->get('/orders/' . $order->orders_id . '/edit/');
    $response->assertSee('<form id="order-edit-form" class="form-horizontal" action="' . route('orders.update', ['id' => $order->id]) . '" method="POST">');
    $response->assertSee('<input class="form-control" type="text" name="name" value="' . $order->name . '" id="name" required>');
    $response->assertSee('<input class="form-control" type="text" name="description" value="' . $order->description . '" ide="description" required>');
    $response->assertSee('<input class="form-control" type="text" name="patient_id" id="patient_id" value="' . $order->patient_id . '"');
    $response->assertSee('<select id="completed" class="form-control" name="completed" form="order-edit-form" value="' . $order->completed . '"><option value="0">No</option><option value="1">Yes</option></select>');
    $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
    $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
  }
}
