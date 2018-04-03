@extends("layouts.app")
@section("title", "Vitae NET Patient Data Formatter")
@section("content")
<div class="col-panel">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading"><h3>Patient Data Formatter</h3></div>
    <div class="panel-body">
      <form class="form-horizontal">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="mrn">MRN:</label>
            <input type="text" id="mrn" name="mrn">
          </div>
          <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname">
          </div>
          <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname">
          </div>
          <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="text" id="dob" name="dob">
          </div>
          <div class="form-group">
            <label for="sex">Sex:</label>
            <input type="text" id="sex" name="sex">
          </div>
          <div class="form-group">
            <label for="height">Height:</label>
            <input type="text" id="height" name="height">
          </div>
          <div class="form-group">
            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight">
          </div>
          <div class="form-group">
            <label for="diagnosis">Diagnosis:</label>
            <input type="text" id="diagnosis" name="diagnosis">
          </div>
          <div class="form-group">
            <label for="allergies">Allergies:</label>
            <input type="text" id="allergies" name="allergies">
          </div>
          <div class="form-group">
            <label for="code">Code Status:</label>
            <input type="text" id="code" name="code">
          </div>
          <div class="form-group">
            <label for="phsyician">Physician:</label>
            <input type="text" id="physician" name="physician">
          </div>
          <div class="form-group">
            <label for="room">Room:</label>
            <input type="text" id="room" name="room">
          </div>
        </div>
      </form>
      <div class="col-sm-6">
          <button type="button" id="patient-format" class="btn btn-default">Format</button>
          <p>Formatted code data:</p>
          <p id="output"></p>
      </div>
    </div>
  </div>
</div>
@endsection
