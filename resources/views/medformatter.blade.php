@extends("layouts.app")
@section("title", "Vitae NET Medication Data Formatter")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading">Medication Data Formatter</div>
    <div class="panel-body">
      <div class="col-sm-4">
        <label for="primary_name">Primary Name:</label>
        <input type="text" id="primary_name" name="primary_name" /><br /><br />
        <label for="primary_amount">Primary Dosage Amount:</label>
        <input type="text" id="primary_amount" name="primary_amount" /><br /><br />
        <label for="primary_unit">Primary Dosage Unit:</label>
        <input type="text" id="primary_unit" name="primary_unit" /><br /><br />
        <label for="secondary_name">Secondary Name:</label>
        <input type="text" id="secondary_name" name="secondary_name" /><br /><br />
        <label for="second_amount">Second Dosage Amount:</label>
        <input type="text" id="second_amount" name="second_amount" /><br /><br />
        <label for="second_unit">Second Dosage Unit:</label>
        <input type="text" id="second_unit" name="second_unit" /><br /><br />
        <label for="second_type">Second Type:</label>
        <input type="text" id="second_type" name="second_type" /><br /><br />
        <label for="comments">Comments:</label>
        <input type="text" id="comments" name="comments" />
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
@endsection
