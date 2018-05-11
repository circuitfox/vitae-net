@extends("layouts.app")
@section("title", "Vitae NET - Summary Page")
@section("content")
<div id="summary-page">
  <div class="col-panel">
    <div id="panel" class="panel panel-default">
      <div class="panel-heading"><h3>Scan</h3></div>
      <div class="panel-body">
        <div id="scan-error-alert"></div>
        <div id="scan-med-alert"></div>
        <form id="scan-form" class="form-horizontal" action="{{ url('/scan') }}" method="POST">
          {{ csrf_field() }}
          <patient :form="true"></patient>
          <medication-list :form="true"></medication-list>
          <div id="form-extra" style="display: none">
            <div class="form-group">
              <label class="col-md-2 control-label" for="student_name">Nurse:</label>
              <div class="col-md-4">
                <input id="student-name" class="form-control" type="text" name="student_name" required>
                @if ($errors->has('student_name'))
                  <span class="help-block">
                    {{ $errors->first('student_name') }}
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="time">Time:</label>
              <div class="col-md-2">
                <input id="time" class="form-control" type="text" pattern="\(0?[0-9]|1\d|2[0-3])(\.|:)[0-5]\d" placeholder="hh:mm" title="24-hour Time" name="time" maxlength="5" required>
                @if ($errors->has('time'))
                  <span class="help-block">
                    {{ $errors->first('time') }}
                  </span>
                @endif
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
