<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersCreatePageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasOrderFormList()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $response = $this->actingAs($user)->get('/orders/create');
    $response->assertSee('<h3>Create new order</h3>');
    $response->assertSee('<form class="form-horizontal" method="POST" action="/orders">');
    $response->assertSee('<label for="name" class="col-md-2 control-label">Name:</label>');
    $response->assertSee('<input type="text" class="form-control" id="name" name="name" required>');
    $response->assertSee('<label for="doc" class="col-md-2 control-label">Orders document:</label>');
    $response->assertSee('<input type="file" id="doc" name="doc" required>');
    $response->assertSee('<p class="help-block">Upload the desired file here:</p>');
    $response->assertSee('<label for="description" class="col-md-2 control-label">Description:</label>');
    $response->assertSee('<input type="text" class="form-control" id="description" name="description" required>');
    $response->assertSee('<label for="patient_id" class="col-md-2 control-label">Patient ID:</label>');
    $response->assertSee('<input type="text" class="form-control" id="patient_id" name="patient_id" required>');
    $response->assertSee('<label for="completed" class="col-md-2 control-label">Completed:</label>');
    $response->assertSee('<select id="completed" class="form-control" name="completed"><option value="0">No</option><option value="1">Yes</option></select>');
    $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
    $response->assertSee('<button type="submit" class="btn btn-primary">Submit</button>');
  }
}
