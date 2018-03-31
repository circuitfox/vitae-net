@extends("layouts.app")
@section("title", "Vitae NET Medication Data Formatter")
@section("content")
<div class="col-panel">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading">Medication Data Formatter</div>
    <div class="panel-body">
      <form class="form-horizontal">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="primary_name">Primary Name:</label>
            <input type="text" id="primary_name" name="primary_name">
          </div>
          <div class="form-group">
            <label for="primary_amount">Primary Dosage Amount:</label>
            <input type="text" id="primary_amount" name="primary_amount">
          </div>
          <div class="form-group">
            <label for="primary_unit">Primary Dosage Unit:</label>
            <input type="text" id="primary_unit" name="primary_unit">
          </div>
          <div class="form-group">
            <label for="secondary_name">Secondary Name:</label>
            <input type="text" id="secondary_name" name="secondary_name">
          </div>
          <div class="form-group">
            <label for="second_amount">Second Dosage Amount:</label>
            <input type="text" id="second_amount" name="second_amount">
          </div>
          <div class="form-group">
            <label for="second_unit">Second Dosage Unit:</label>
            <input type="text" id="second_unit" name="second_unit">
          </div>
          <div class="form-group">
            <label for="second_type">Second Type:</label>
            <input type="text" id="second_type" name="second_type">
          </div>
          <div class="form-group">
            <label for="comments">Comments:</label>
            <input type="text" id="comments" name="comments">
          </div>
        </div>
      </form>
      <div class="col-sm-offset col-sm-6">
        <button type="button" id="med-format" class="btn btn-default">Format</button>
        <p>Formatted code data:</p>
        <p id="output"></p>
      </div>
    </div>
  </div>
</div>
@endsection
