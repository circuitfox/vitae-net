<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabEditPageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasForm()
  {
    $user = factory(\App\User::class)->create();
    $lab = factory(\App\Lab::class)->create();
    $response = $this->actingAs($user)->get('/labs/' . $lab->lab_id . '/edit');
    $response->assertSee('<form id="lab-edit-form" class="form-horizontal" action="' . route('labs.update', ['id' => $lab->id]) . '" method="POST">');
    $response->assertSee('<input class="form-control" type="text" name="name" value="' . $lab->name . '" id="name" required>');
    $response->assertSee('<input class="form-control" type="text" name="description" value="' . $lab->description . '" id="description" required>');
    $response->assertSee('<input class="form-control" type="text" name="patient_id" value="' . $lab->patient_id . '" id="patient_id">');
    $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
    $response->assertSee('<button class="btn btn-primary" type="submit">Submit</button>');
  }
}
