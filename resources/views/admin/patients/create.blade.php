@extends("layouts.app")
@section("title", "Vitae NET Administration - Patients")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">Add Patient</div>
    <div class="panel-body">
      <div id="scan-error-alert"></div>
      <form id="patient-form" class="form-horizontal" action="{{ route('patients.store') }}" method="POST">
        {{ csrf_field() }}
        <patient-form :errors="{{ json_encode($errors->getMessages()) }}"></patient-form>
        <div class="col-md-offset-2 col-md-2">
          <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
          <button class="btn btn-primary" type="submit">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
