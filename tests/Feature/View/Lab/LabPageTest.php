<?php

namespace Tests\Feature\View\Lab;

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

    public function testHasPDF()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $lab = factory(\App\Lab::class)->create();
        $pdf = asset('storage/' . $lab->file_path);
        $response = $this->actingAs($user)->get('/labs/' . $lab->id);
        $response->assertSee('<div class="col-md-7" style="height:500px;">');
        $response->assertSee('<object data="' . $pdf . '" type="application/pdf" width="100%" height="100%">');
        $response->assertSee('<iframe src="' . $pdf . '" width="100%" height="100%" style="border:none;">');
        $response->assertSee('This browser does not support embedding PDF documents. Please download');
        $response->assertSee('the PDF to view it. <a href="' . $pdf . '">Download PDF</a>');
    }

    public function testHasWarning()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $lab = factory(\App\Lab::class)->create();
        $response = $this->actingAs($user)->get('/labs/' . $lab->id);
        $response->assertSee('<div id="reminder" class="alert alert-warning">');
        $response->assertSee('<h4 class="text-center">Click "Scan Medication" above before administering medication.</h4>');
    }

    public function testHasButtonIfAssigned()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $lab = factory(\App\Lab::class)->states('assigned')->create();
        $response = $this->actingAs($user)->get('/labs/' . $lab->id);
        $response->assertSee('<a class="btn btn-primary" href="/patients/' . $lab->patient_id . '">Back to Patient</a>');
        $response->assertSee('<p>' . $lab->patient_id . '</p>');
    }

    public function testNoButtonIfUnassigned()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $lab = factory(\App\Lab::class)->states('unassigned')->create();
        $response = $this->actingAs($user)->get('/labs/' . $lab->id);
        $response->assertDontSee('<a class="btn btn-primary" href="/patients/' . $lab->patient_id . '">Back to Patient</a>');
        $response->assertSee('<p>Not assigned to patient</p>');
    }
}
