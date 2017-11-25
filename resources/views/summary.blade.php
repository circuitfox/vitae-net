@extends("layouts.app");
@section("title", "Medscanner - Summary Page")
@section("content")
<div id="summary-page">
  <div class="col-md-offset-2 col-md-8">
    <div id="panel" class="panel panel-default">
      <div class="panel-heading">Scan</div>
      <div class="panel-body">
        <form id="scan-form" class="form-horizontal" action="{{ url('/scan') }}" method="POST">
          {{ csrf_field() }}
          <patient :form="true"></patient>
          <medication-list :form="true"></medication-list>
          <div id="form-extra" style="display: none">
            <div class="form-group">
              <label class="col-md-2 control-label" for="initials">Initials:</label>
              <div class="col-md-3">
                <input id="initials" class="form-control" type="text" name="initials" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="time">Time:</label>
              <div class="col-md-3">
                <input id="time" class="form-control" type="time" name="time" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-offset-2 col-md-2">
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
