<?php

namespace Tests\Feature;

use Tests\TestCase;

class SummaryPageTest extends TestCase
{
    public function testForm()
    {
        $response = $this->get('/scan');
        $response->assertSee('<form id="scan-form" class="form-horizontal" action="' . url('/scan') . '" method="POST">');
    }
    public function testPatient()
    {
        $response = $this->get('/scan');
        $response->assertSee('<patient :form="true"></patient>');
    }

    public function testMedicationList()
    {
        $response = $this->get('/scan');
        $response->assertSee('<medication-list :form="true"></medication-list>');
    }
    public function testHiddenForm()
    {
        $response = $this->get('/scan');
        $prev = url('/');
        $response->assertSee(<<<HTML
          <div id="form-extra" style="display: none">
            <div class="form-group">
              <label class="col-md-2 control-label" for="initials">Initials:</label>
              <div class="col-md-3">
                <input id="initials" class="form-control" type="text" name="initials" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="time">Time:</label>
              <div class="col-md-3">
                <input id="time" class="form-control" type="time" name="time" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-offset-2 col-md-6">
                <a class="btn btn-default" href="{$prev}">Cancel</a>
                <button class="btn btn-primary" type="submit">Accept</button>
              </div>
            </div>
          </div>
HTML
        );
    }

    public function testRedirects()
    {
        $response = $this->post('/scan');
        $response->assertRedirect('/');
    }
}
