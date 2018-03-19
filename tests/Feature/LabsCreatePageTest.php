<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabsCreatePageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasLabFormList()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $response = $this->actingAs($user)->get('/labs/create');
    $response->assertSee('<h3>Create new lab result</h3>');
    $response->assertSee('<form class="form-horizontal" method="POST" action="/labs" enctype="multipart/form-data">');
    $response->assertSee('<label for="name" class="col-md-2 control-label">Name:</label>');
    $response->assertSee('<input type="text" class="form-control" id="name" name="name" required>');
    $response->assertSee('<label for="doc" class="col-md-2 control-label">Lab result document:</label>');
    $response->assertSee('<input type="file" id="doc" name="doc" required>');
    $response->assertSee('<p class="help-block">Upload the desired file here</p>');
    $response->assertSee('<label for="description" class="col-md-2 control-label">Description:</label>');
    $response->assertSee('<input type="text" class="form-control" id="description" name="description" required>');
    $response->assertSee('<label for="patient_id" class="col-md-2 control-label">Patient:</label>');
    $response->assertSee('<select id="patient_id" class="form-control" name="patient_id">');
    $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
    $response->assertSee('<button type="submit" class="btn btn-primary">Submit</button>');
  }
}
