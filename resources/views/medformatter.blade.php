@extends("layouts.app")
@section("title", "Vitae NET Medication Data Formatter")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading">Medication Data Formatter</div>
    <div class="panel-body">
      <div class="col-sm-4">
        <label for="primary_name" class="pull-left">Primary Name:</label>
        <input type="text" id="primary_name" name="primary_name" class="pull-right" /><br /><br />
        <label for="primary_amount" class="pull-left">Primary Dosage Amount:</label>
        <input type="text" id="primary_amount" name="primary_amount" class="pull-right" /><br /><br />
        <label for="primary_unit" class="pull-left">Primary Dosage Unit:</label>
        <input type="text" id="primary_unit" name="primary_unit" class="pull-right" /><br /><br />
        <label for="secondary_name" class="pull-left">Secondary Name:</label>
        <input type="text" id="secondary_name" name="secondary_name" class="pull-right" /><br /><br />
        <label for="second_amount" class="pull-left">Second Dosage Amount:</label>
        <input type="text" id="second_amount" name="second_amount" class="pull-right" /><br /><br />
        <label for="second_unit" class="pull-left">Second Dosage Unit:</label>
        <input type="text" id="second_unit" name="second_unit" class="pull-right" /><br /><br />
        <label for="second_type" class="pull-left">Second Type:</label>
        <input type="text" id="second_type" name="second_type" class="pull-right" /><br /><br />
        <label for="comments" class="pull-left">Comments:</label>
        <input type="text" id="comments" name="comments" class="pull-right" />
      </div>
      <div class="col-sm-8">
        <button type="button" id="med-format" class="pull-right">Format</button>
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
