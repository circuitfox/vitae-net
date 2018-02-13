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
    $order =factory(\App\Order::class)->states('incomplete')->create();
    $order->update();
    $response = $this->actingAs($user)->get('/orders/' . $order->id . '/edit/');
    $response->assertSee('<form id="order-edit-form" class="form-horizontal" action="' . route('orders.update', ['id' => $order->id]) . '" method="POST">');
    $response->assertSee('<input class="form-control" type="text" name="name" value="' . $order->name . '" id="name" required>');
    $response->assertSee('<input class="form-control" type="text" name="description" value="' . $order->description . '" id="description" required>');
    $response->assertSee('<input class="form-control" type="text" name="patient_id" id="patient_id" value="' . $order->patient_id . '"');
    $response->assertSee('<select id="completed" class="form-control" name="completed" form="order-edit-form">');
    $response->assertSee('<option value="0" selected="selected">No</option');
    $response->assertSee('<option value="1" selected="">Yes</option');
    $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
    $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
  }

  public function testHasFormCompleted()
  {
    $user = factory(\App\User::class)->create();
    $order =factory(\App\Order::class)->states('complete')->create();
    $order->update();
    $response = $this->actingAs($user)->get('/orders/' . $order->id . '/edit/');
    $response->assertSee('<form id="order-edit-form" class="form-horizontal" action="' . route('orders.update', ['id' => $order->id]) . '" method="POST">');
    $response->assertSee('<input class="form-control" type="text" name="name" value="' . $order->name . '" id="name" required>');
    $response->assertSee('<input class="form-control" type="text" name="description" value="' . $order->description . '" id="description" required>');
    $response->assertSee('<input class="form-control" type="text" name="patient_id" id="patient_id" value="' . $order->patient_id . '"');
    $response->assertSee('<select id="completed" class="form-control" name="completed" form="order-edit-form">');
    $response->assertSee('<option value="0" selected="">No</option');
    $response->assertSee('<option value="1" selected="selected">Yes</option');
    $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
    $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
  }
}
