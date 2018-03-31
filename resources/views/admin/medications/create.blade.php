@extends("layouts.app")
@section("title", "Vitae NET Administration - Medication")
@section("content")
<div class="col-panel">
  <div class="panel panel-default">
    <div class="panel-heading">Add Medication</div>
    <div class="panel-body">
      <div id="scan-error-alert"></div>
      <form id="medication-form" class="form-horizontal" action="{{ route('medications.store') }}" method="POST">
        {{ csrf_field() }}
        <medication-form-list :errors="{{ json_encode($errors->getMessages()) }}"
                              :old="{{ json_encode(old('meds')) }}">
        </medication-form-list>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-4">
            <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
            <button class="btn btn-default" type="button" id="add-medication">Add</button>
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
