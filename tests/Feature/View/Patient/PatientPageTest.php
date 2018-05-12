<?php

namespace Tests\Feature\View\Patient;

use App\Medication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientPageTest extends TestCase
{
    use RefreshDatabase;

    public function testHasPatient()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number);
        $response->assertSee('<h3>'
            . $this->faker_escape($patient->first_name . ' ' . $patient->last_name)
            . ' (MRN: ' . $patient->medical_record_number . ')</h3>');
        $response->assertSee('<h5><b><u>Name:</u></b></h5>');
        $response->assertSee($this->faker_escape($patient->first_name . ' ' . $patient->last_name));
        $response->assertSee('<h5><b><u>Date Of Birth:</u></b></h5>');
        $response->assertSee($patient->date_of_birth);
        $response->assertSee('<h5><b><u>Sex:</u></b></h5>');
        $response->assertSee(($patient->sex ? 'Male' : 'Female'));
        $response->assertSee('<h5><b><u>Height:</u></b></h5>');
        $response->assertSee($patient->height);
        $response->assertSee('<h5><b><u>Weight:</u></b></h5>');
        $response->assertSee($patient->weight);
        $response->assertSee('<h5><b><u>Diagnosis:</u></b></h5>');
        $response->assertSee($patient->diagnosis);
        $response->assertSee('<h5><b><u>Allergies:</u></b></h5>');
        $response->assertSee($patient->allergies);
        $response->assertSee('<h5><b><u>Code Status:</u></b></h5>');
        $response->assertSee($patient->code_status);
        $response->assertSee('<h5><b><u>Physician:</u></b></h5>');
        $response->assertSee($this->faker_escape($patient->physician));
        $response->assertSee('<h5><b><u>Room:</u></b></h5>');
        $response->assertSee($patient->room);
        $response->assertSee('<a href="#labs" class="collapsed" role="button" data-toggle="collapse"><h3>Lab Results</h3></a>');
        $response->assertSee('<div id="labs" class="panel-collapse collapse in" role="tabpanel"');
        $response->assertSee('<a href="#orders" class="collapsed" role="button" data-toggle="collapse"><h3>Provider\'s Orders</h3></a>');
        $response->assertSee('<div id="orders" class="panel-collapse collapse in" role="tabpanel"');
        $response->assertSee('<div id="mar" class="col-panel">');
        $response->assertSee('<a class="btn btn-success h3" href="/mars/create/' . $patient->medical_record_number . '">Add Prescription</a>');
        $response->assertSee('<h5 class="text-center text-muted">No entries in the MAR</h5>');
        $response->assertSee('<div id="assessment" class="col-panel">');
        $response->assertSee('<a class="btn btn-success h3" href="/assessments/' . $patient->medical_record_number . '">View Assessments</a>');
    }

    public function testCanEditMAR() {
        $user = factory(\App\User::class)->states('admin')->create();
        $marEntry = factory(\App\MarEntry::class)->create();
        $patient = $marEntry->patient;
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number);
        $response->assertSee('<div id="mar" class="col-panel">');
        $response->assertSee('<a class="btn btn-success h3" href="/mars/create/' . $patient->medical_record_number . '">Add Prescription</a>');
        $response->assertSee('<table class="table table-hover">');
        $response->assertSee('<th>Edit</th>');
    }

    public function testStudentCantEditMAR() {
        $user = factory(\App\User::class)->states('student')->create();
        $marEntry = factory(\App\MarEntry::class)->create();
        $patient = $marEntry->patient;
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number);
        $response->assertSee('<div id="mar" class="col-panel">');
        $response->assertDontSee('<a class="btn btn-success h3" href="/mars/create/' . $patient->medical_record_number . '">Add Prescription</a>');
        $response->assertSee('<table class="table table-hover">');
        $response->assertDontSee('<th>Edit</th>');
    }

    public function testMARHasStatPRN()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $marEntry = factory(\App\MarEntry::class)->states('stat')->create();
        $patient = $marEntry->patient;
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number);
        $response->assertSee('<td colspan="16" class="stat-header"><b> STAT/PRN </b></td>');
    }

    public function testHasLabs()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $lab = factory(\App\Lab::class)->create();
        $response = $this->actingAs($user)->get('/patients/' . $lab->patient_id);
        $response->assertSee('<a class="list-group-item list-group-item-danger" href="'
            . route('labs.show', ['id' => $lab->id]) . '">'
            . $lab->name . '</a>');
    }

    public function testHasVisitedLabs()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $lab = factory(\App\Lab::class)->create();
        $this->actingAs($user)->get('/labs/' . $lab->id);
        $response = $this->actingAs($user)->get('/patients/' . $lab->patient_id);
        $response->assertSee('<a class="list-group-item list-group-item-success" href="'
            . route('labs.show', ['id' => $lab->id]) . '">'
            . $lab->name . '</a>');
    }

    public function testHasIncompleteOrder()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $order = factory(\App\Order::class)->states('incomplete')->create();
        $response = $this->actingAs($user)->get('/patients/' . $order->patient_id);
        $response->assertSee('<a class="list-group-item list-group-item-danger" href="'
            . route('orders.show', ['id' => $order->id]) . '">');
        $response->assertSee($order->name);
        $response->assertSee('</a>');
    }

    public function testHasCompleteOrder()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $order = factory(\App\Order::class)->states('complete')->create();
        $response = $this->actingAs($user)->get('/patients/' . $order->patient_id);
        $response->assertSee('<a class="list-group-item list-group-item-success" href="'
            . route('orders.show', ['id' => $order->id]) . '">');
        $response->assertSee($order->name);
        $response->assertSee('</a>');
    }

    public function testHasBarcodeAsPrivileged()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($user)->get('/patients');
        $response->assertSee('<h5><b><u>Bar Code</u></b></h5>');
        $response->assertSee($patient->generateBarcode());
    }

    public function testNoBarcodeAsStudent()
    {
        $user = factory(\App\User::class)->states('student')->create();
        $patient = factory(\App\Patient::class)->create();
        $response = $this->actingAs($user)->get('/patients');
        $response->assertDontSee('<h5><b><u>Bar Code</u></b></h5>');
        $response->assertDontSee($patient->generateBarcode());
    }

    public function testHasMarEntry()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $marEntry = factory(\App\MarEntry::class)->create();
        $meds = [$marEntry->Medication->toMarArray()];
        $complete = session('complete.' . $marEntry->medical_record_number);
        if ($complete === null) {
            $complete = [];
        }
        $response = $this->actingAs($user)->get('/patients/' . $marEntry->medical_record_number);
        $response->assertSee('<tr is="mar-entry"');
        $response->assertSee(':meds="' . $this->faker_escape(json_encode($meds)) . '"');
        $response->assertSee(':mar-entry="' . $this->faker_escape($marEntry->toJsonArray()) . '"');
        $response->assertSee(':is-admin="' . $this->faker_escape(json_encode($user->isAdmin())) . '"');
        $response->assertSee('route="' . route('mars.update', ['id' => $marEntry->id]) . '"');
        $response->assertSee(':complete="' . $this->faker_escape(json_encode($complete)) . '">');
    }

    public function testHasAssessmentForm()
    {
        $user = factory(\App\User::class)->states('student')->create();
        $patient = factory(\App\Patient::class)->create();
        $assessment = ['id' => 0];
        $response = $this->actingAs($user)->get('/patients/' . $patient->medical_record_number);
        $response->assertSee('<div id="assessment" class="col-panel">');
        $response->assertSee('<assessment-form id="assessment-form"');
        $response->assertSee(':assessment="' . $this->faker_escape(json_encode($assessment)) . '"');
        $response->assertSee(':errors="' . $this->faker_escape(json_encode([])) . '"');
        $response->assertSee('mrn="' . $patient->medical_record_number . '"');
        $response->assertSee('route="' . route('assessments.update') . '">');
    }
}
