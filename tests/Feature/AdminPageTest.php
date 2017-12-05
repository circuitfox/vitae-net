<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminPageTest extends TestCase
{
    public function testHasPanel()
    {
        $user = factory(\App\User::class)->states('admin')->create();
        $users = url('/users');
        $userscreate = url('/users/create');
        $meds = url('/medications');
        $medscreate = url('/medications/create');
        $patients = url('/patients');
        $patientscreate = url('/patients/create');
        $response = $this->actingAs($user)->get('/admin');
        $response->assertSee(<<<HTML
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading">Administrator Dashboard</div>
    <div class="panel-body">
      <p>Administrator options:</p>
      <p><a class="btn btn-primary" href="$users">View Users</a>&nbsp;View and edit existing users.</p>
      <p><a class="btn btn-primary" href="$userscreate">Create User</a>&nbsp;Create new user.</p>
      <p><a class="btn btn-primary" href="$meds">View Medications</a>&nbsp;View and edit existing medications.</p>
      <p><a class="btn btn-primary" href="$medscreate">Create Medication</a>&nbsp;Add new medication.</p>
      <p><a class="btn btn-primary" href="$patients">View Patients</a>&nbsp;View and edit existing patients.</p>
      <p><a class="btn btn-primary" href="$patientscreate">Create Patient</a>&nbsp;Create new patient.</p>
    </div>
  </div>
</div>
HTML
        );
    }
}
