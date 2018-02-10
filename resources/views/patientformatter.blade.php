@extends("layouts.app")
@section("title", "Vitae NET Patient Data Formatter")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading">Patient Data Formatter</div>
    <div class="panel-body">
      <div class="col-sm-4">
        <label for="mrn">MRN:</label>
        <input type="text" id="mrn" name="mrn" /><br /><br />
        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" /><br /><br />
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" /><br /><br />
        <label for="dob">Date of Birth:</label>
        <input type="text" id="dob" name="dob" /><br /><br />
        <label for="sex">Sex:</label>
        <input type="text" id="sex" name="sex" /><br /><br />
        <label for="height">Height:</label>
        <input type="text" id="height" name="height" /><br /><br />
        <label for="weight">Weight:</label>
        <input type="text" id="weight" name="weight" /><br /><br />
        <label for="diagnosis">Diagnosis:</label>
        <input type="text" id="diagnosis" name="diagnosis" /><br /><br />
        <label for="allergies">Allergies:</label>
        <input type="text" id="allergies" name="allergies" /><br /><br />
        <label for="code">Code Status:</label>
        <input type="text" id="code" name="code" /><br /><br />
        <label for="phsyician">Physician:</label>
        <input type="text" id="physician" name="physician" /><br /><br />
        <label for="room">Room:</label>
        <input type="text" id="room" name="room" />
      </div>
      <div class="col-sm-8">
        <button type="button" id="format" class="pull-right">Format</button>
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
