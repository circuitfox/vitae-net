<?php

namespace Tests\Feature\View\Lab;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabsPageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasLab()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $lab = factory(\App\Lab::class)->create();
    $response = $this->actingAs($user)->get('/labs');
    $response->assertSee('<h3>' . $lab->name . '</h3>');
    $response->assertSee('<h5><b><u>Name:</u></b></h5>');
    $response->assertSee('<p>' . $lab->name . '</p>');
    $response->assertSee('<h5><b><u>Description:</u></b></h5>');
    $response->assertSee('<p>' . $lab->description . '</p>');
    $response->assertSee('<h5><b><u>Patient MRN:</u></b></h5>');
    $response->assertSee('<p>' . $lab->patient_id . '</p>');
    $response->assertSee('<a href="/labs/' . $lab->id . '" class="btn btn-default">Details</a>');
    $response->assertSee('<a href="/labs/' . $lab->id . '/edit" class="btn btn-primary">Edit</a>');
    $response->assertSee('<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#lab-delete-modal" data-id="' . $lab->id . '">Delete</button>');

  }

  public function testHasModal()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $lab = factory(\App\Lab::class)->create();
    $response = $this->actingAs($user)->get('/labs/');
    $response->assertSee('<button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>');
    $response->assertSee('<h4 class="modal-title">Delete Lab</h4>');
    $response->assertSee('<p>Are you sure you want to delete this lab?</p>');
    $response->assertSee('<button type="button" class="btn btn-default col-md-offset-8 col-md-2" data-dismiss="modal">No</button>');
    $response->assertSee('<form name="delete-lab" action="" method="post" id="delete-lab">');
    $response->assertSee('<button type="submit" class="btn btn-danger col-md-2">Yes</button>');
  }

  public function testHasAddbuttonIfEmpty()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $response = $this->actingAs($user)->get('/labs/');
    $response->assertSee('<h3 class="text-center">No labs in the database.</h3>');
    $response->assertSee('<a href="' . route('labs.create') . '" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Labs</a>');
  }

  public function testHasNoAddbuttonIfEmptyAsStudent()
  {
    $user = factory(\App\User::class)->states('student')->create();
    $response = $this->actingAs($user)->get('/labs/');
    $response->assertSee('<h3 class="text-center">No labs in the database.</h3>');
    $response->assertDontSee('<a href="' . route('labs.create') . '" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Labs</a>');
  }

  public function testHasHeader()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $lab = factory(\App\Lab::class)->create();
    $response = $this->actingAs($user)->get('/labs');
    $response->assertSee('<a class="btn btn-success" href="' . route('labs.create') . '">Add Lab</a>');
    $response->assertSee('<h2>Labs</h2>');
  }

  public function testNoAddIfStudent()
  {
    $user = factory(\App\User::class)->states('student')->create();
    $lab = factory(\App\Lab::class)->create();
    $response = $this->actingAs($user)->get('/labs');
    $response->assertDontSee('<a class="btn btn-success" href="' . route('labs.create') . '">Add Lab</a>');
    $response->assertSee('<h2>Labs</h2>');
  }

  public function testNoEditDeleteIfStudent()
  {
    $user = factory(\App\User::class)->states('student')->create();
    $lab = factory(\App\Lab::class)->create();
    $response = $this->actingAs($user)->get('/labs');
    $response->assertDontSee('<a href="/labs/' . $lab->id . '/edit" class="btn btn-primary">Edit</a>');
    $response->assertDontSee('<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#lab-delete-modal" data-id="' . $lab->id . '">Delete</button>');
  }
}
