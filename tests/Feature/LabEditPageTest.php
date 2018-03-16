<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabEditPageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasForm()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $lab = factory(\App\Lab::class)->create();
    $response = $this->actingAs($user)->get('/labs/' . $lab->id . '/edit');
    $response->assertSee('<form id="lab-edit-form" class="form-horizontal" action="' . route('labs.update', ['id' => $lab->id]) . '" method="POST">');
    $response->assertSee('<input class="form-control" type="text" name="name" value="' . $lab->name . '" id="name" required>');
    $response->assertSee('<input class="form-control" type="text" name="description" value="' . $lab->description . '" id="description" required>');
    $response->assertSee('<select id="patient_id" class="form-control" name="patient_id">');
    $response->assertSee('<option value="' . $lab->patient_id . '" selected="selected">');
    $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
    $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
  }
}
