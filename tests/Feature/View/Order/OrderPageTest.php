<?php

namespace Tests\Feature\View\Order;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasOrder()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $order = factory(\App\Order::class)->create();
        $response = $this->actingAs($user)->get('/orders/' . $order->id);
        $response->assertSee('<h3>' . $order->name . '</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $order->name . '</p>');
        $response->assertSee('<h5><b><u>Description:</u></b></h5>');
        $response->assertSee('<p>' . $order->description . '</p>');
        $response->assertSee('<h5><b><u>Patient MRN:</u></b></h5>');
        $response->assertSee('<p>' . $order->patient_id . '</p>');
        $response->assertSee('<h5><b><u>Completed:</u></b></h5>');
        $response->assertSee('<p>' . ($order->completed ? 'Yes': 'No') . '</p>');
    }

    public function testHasPDF()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $order = factory(\App\Order::class)->create();
        $pdf = asset('storage/' . $order->file_path);
        $response = $this->actingAs($user)->get('/orders/' . $order->id);
        $response->assertSee('<div class="col-md-7" style="height:500px;">');
        $response->assertSee('<object data="' . $pdf . '" type="application/pdf" width="100%" height="100%">');
        $response->assertSee('<iframe src="' . $pdf . '" width="100%" height="100%" style="border:none;">');
        $response->assertSee('This browser does not support embedding PDF documents. Please download');
        $response->assertSee('the PDF to view it. <a href="' . $pdf . '">Download PDF</a>');
    }

    public function testHasOrderAsStudent()
    {
        $user = factory(\App\User::class)->states('student')->create();
        $order = factory(\App\Order::class)->create();
        $response = $this->actingAs($user)->get('/orders/' . $order->id);
        $response->assertSee('<h3>' . $order->name . '</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee('<p>' . $order->name . '</p>');
        $response->assertSee('<h5><b><u>Description:</u></b></h5>');
        $response->assertSee('<p>' . $order->description . '</p>');
        $response->assertSee('<h5><b><u>Patient MRN:</u></b></h5>');
        $response->assertSee('<p>' . $order->patient_id . '</p>');
        $response->assertSee('<h5><b><u>Completed:</u></b></h5>');
        $response->assertSee('<p>' . ($order->completed ? 'Yes': 'No') . '</p>');
        $response->assertSee('<button type="submit" class="btn btn-primary">Complete Order</button>');
    }

    public function testHasWarning()
    {
        $user = factory(\App\User::class)->states('student')->create();
        $order = factory(\App\Order::class)->create();
        $response = $this->actingAs($user)->get('/orders/' . $order->id);
        $response->assertSee('<div id="reminder" class="alert alert-warning">');
        $response->assertSee('<h4 class="text-center">Click "Scan Medication" above before administering medication.</h4>');
    }

    public function testHasButtonsIfAssigned()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $order = factory(\App\Order::class)->create();
        $response = $this->actingAs($user)->get('/orders/' . $order->id);
        $response->assertSee('<a class="pull-right btn btn-primary" href="/patients/' . $order->patient_id . '" style="margin-top:10px;">Back to Patient</a>');
        $response->assertSee('<button type="submit" class="btn btn-primary">Complete Order</button>');
        $response->assertSee('<p>' . $order->patient_id . '</p>');
    }

    public function testNoButtonsIfUnassigned()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $order = factory(\App\Order::class)->states('unassigned')->create();
        $response = $this->actingAs($user)->get('/orders/' . $order->id);
        $response->assertDontSee('<a class="pull-right btn btn-primary" href="/patients/' . $order->patient_id . '" style="margin-top:10px;">Back to Patient</a>');
        $response->assertDontSee('<button type="submit" class="btn btn-primary">Complete Order</button>');
        $response->assertSee('<p>Not assigned to patient</p>');
    }
}
