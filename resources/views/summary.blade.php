@extends("layouts.app")
@section("title", "Vitae NET - Summary Page")
@section("content")
<div id="summary-page">
  <div class="col-md-offset-2 col-md-8">
    <div id="panel" class="panel panel-default">
      <div class="panel-heading">Scan</div>
      <div class="panel-body">
        <div id="scan-error-alert"></div>
        <form id="scan-form" class="form-horizontal" action="{{ url('/scan') }}" method="POST">
          {{ csrf_field() }}
          <patient :form="true"></patient>
          <medication-list :form="true"></medication-list>
          <div id="form-extra" style="display: none">
            <div class="form-group">
              <label class="col-md-2 control-label" for="student_name">Name:</label>
              <div class="col-md-4">
                <input id="student-name" class="form-control" type="text" name="student_name" required>
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
                <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
                <button class="btn btn-primary" type="submit">Accept</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
