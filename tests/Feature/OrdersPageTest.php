<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersPageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasOrder()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $order = factory(\App\Order::class)->create();
    $response = $this->actingAs($user)->get('/orders' . $order->id);
    $response->assertSee('<h3>' . $order->name . '</h3>');
    $response->assertSee('<h5><b><u>Name:</u></b></h5>');
    $response->assertSee('<p>' . $order->name . '</p>');
    $response->assertSee('<h5><b><u>Description:</u></b></h5>');
    $response->assertSee('<p>' . $order->description . '</p>');
    $response->assertSee('<h5><b><u>Patient MRN:</u></b></h5>');
    $response->assertSee('<p>' . $order->patient_id . '</p>');
    $response->assertSee('<h5><b><u>Completed:</u></b></h5>');
    $response->assertSee('<p>' . ($order->completed ? 'Yes': 'No') . '</p>');
    $response->assertSee('<a href="/orders/' . $order->id . '/edit" class="btn btn-primary h3">Edit</a>');
    $response->assertSee('<button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#order-delete-modal" data-id="' . $order->id . '">Delete</button');
  }

  public function testHasModal()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $order = factory(\App\Order::class)->create();
    $response = $this->actingAs($user)->get('/orders/');
    $response->assertSee('<button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>');
    $response->assertSee('<h4 class="modal-title">Delete Order</h4>');
    $response->assertSee('<p>Are you sure you want to delete this order?</p>');
    $response->assertSee('<button type="button" class="btn btn-default col-md-offset-8 col-md-2" data-dismiss="modal">No</button>');
    $response->assertSee('<form name="delete-order" action="" method="post" id="delete-order">');
    $response->assertSee('<button type="submit" class="btn btn-danger col-md-2">Yes</button>');
  }

  public function testHasAddbuttonIfEmpty()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $response = $this->actingAs($user)->get('/orders/');
    $response->assertSee('<h3 class="col-md-offset-2 col-md-8 text-center">No orders in the database. Add some?</h3>');
    $response->assertSee('<a href "' . route('orders.create') . '" class="col-md-offset-5 col-md-2 btn btn-default h3">Add orders</a>');
  }
}
