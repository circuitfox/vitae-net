<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabPageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasLab()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $lab = factory(\App\Lab::class)->create();
    $response = $this->actingAs($user)->get('/labs/' . $lab->id);
    $response->assertSee('<h3>' . $lab->name . '</h3>');
    $response->assertSee('<h5><b><u>Name:</u></b></h5>');
    $response->assertSee('<p>' . $lab->name . '</p>');
    $response->assertSee('<h5><b><u>Description:</u></b></h5>');
    $response->assertSee('<p>' . $lab->description . '</p>');
    $response->assertSee('<h5><b><u>Patient MRN:</u></b></h5>');
    $response->assertSee('<p>' . $lab->patient_id . '</p>');

  }

}
