<?php

namespace Tests\Feature\View;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LandingPageTest extends TestCase
{
    function testHasPanel()
    {
        $medication = url('/medication');
        $orders = url('/home');
        $response = $this->get('/');
        $response->assertSee(<<<HTML
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading">Welcome</div>
    <div class="panel-body">
      <p>Select a module:</p>
      <div class="row">
        <a class="col-md-offset-3 col-md-2 btn btn-primary" href="$orders">Orders</a>
        <a class="col-md-offset-1 col-md-2 btn btn-primary" href="$medication">Medication</a>
      </div>
    </div>
  </div>
</div>
HTML
        );
    }
}
