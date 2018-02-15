@extends("layouts.app")
@section("title", "Vitae NET Patient Data Formatter")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading">Patient Data Formatter</div>
    <div class="panel-body">
      <div class="col-sm-4">
        <label for="mrn" class="pull-left">MRN:</label>
        <input type="text" id="mrn" name="mrn" class="pull-right" /><br /><br />
        <label for="lname" class="pull-left">Last Name:</label>
        <input type="text" id="lname" name="lname" class="pull-right" /><br /><br />
        <label for="fname" class="pull-left">First Name:</label>
        <input type="text" id="fname" name="fname" class="pull-right" /><br /><br />
        <label for="dob" class="pull-left">Date of Birth:</label>
        <input type="text" id="dob" name="dob" class="pull-right" /><br /><br />
        <label for="sex" class="pull-left">Sex:</label>
        <input type="text" id="sex" name="sex" class="pull-right" /><br /><br />
        <label for="height" class="pull-left">Height:</label>
        <input type="text" id="height" name="height" class="pull-right" /><br /><br />
        <label for="weight" class="pull-left">Weight:</label>
        <input type="text" id="weight" name="weight" class="pull-right" /><br /><br />
        <label for="diagnosis" class="pull-left">Diagnosis:</label>
        <input type="text" id="diagnosis" name="diagnosis" class="pull-right" /><br /><br />
        <label for="allergies" class="pull-left">Allergies:</label>
        <input type="text" id="allergies" name="allergies" class="pull-right" /><br /><br />
        <label for="code" class="pull-left">Code Status:</label>
        <input type="text" id="code" name="code" class="pull-right" /><br /><br />
        <label for="phsyician" class="pull-left">Physician:</label>
        <input type="text" id="physician" name="physician" class="pull-right" /><br /><br />
        <label for="room" class="pull-left">Room:</label>
        <input type="text" id="room" name="room" class="pull-right" />
      </div>
      <div class="col-sm-8">
        <button type="button" id="patient-format" class="pull-right">Format</button>
        <br />
        <br />
        <p class="pull-right">Formatted code data:</p>
        <br />
        <p id="output" class="pull-right"></p>
        <br />
      </div>
      </div>
    </div>
  </div>
</div>
@endsection
