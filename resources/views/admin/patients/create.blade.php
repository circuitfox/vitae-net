@extends("layouts.app")
@section("title", "Vitae NET Administration - Patients")
@section("content")
<div class="col-panel">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Add Patient</h3>
    </div>
    <div class="panel-body">
      <div id="scan-error-alert"></div>
      <form id="patient-form" class="form-horizontal" action="{{ route('patients.store') }}" method="POST">
        {{ csrf_field() }}
        <patient-form :errors="{{ json_encode($errors->getMessages()) }}"></patient-form>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-4">
            <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
            <button class="btn btn-primary" type="submit">Add</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
