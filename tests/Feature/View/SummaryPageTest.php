<?php

namespace Tests\Feature\View;

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
        $response->assertSee('<div id="form-extra" style="display: none">');
        $response->assertSee('<label class="col-md-2 control-label" for="student_name">Nurse:</label>');
        $response->assertSee('<input id="student-name" class="form-control" type="text" name="student_name" required>');
        $response->assertSee('<label class="col-md-2 control-label" for="time">Time:</label>');
        $response->assertSee('<input id="time" class="form-control" type="text" pattern="\(0?[0-9]|1\d|2[0-3])(\.|:)[0-5]\d" placeholder="hh:mm" title="24-hour Time" name="time" maxlength="5" required>');
        $response->assertSee('<a class="btn btn-default" href="' . url('/') . '">Cancel</a>');
        $response->assertSee('<button class="btn btn-primary" type="submit">Accept</button>');
    }
}
