@extends("layouts.app")
@section("title", "Vitae NET Administration - MAR Creation")
@section("content")
<div class="col-md-offset-0 col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">Add MAR Entries</div>
    <div class="panel-body">
      <div id="scan-error-alert"></div>
      <form id="mar-form" class="form-inline" action="{{ route('mars.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
          <mar-form-list :errors="{{ json_encode($errors->getMessages()) }}"
                          :old="{{ json_encode(old('mar')) }}"
                          :meds= "{{ $meds }}"
                          :mrn= "{{ $medical_record_number }}"></mar-form-list>
        <div class="col-md-offset-8 col-md-4">
          <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
          <button class="btn btn-default" type="button" id="add-mar">Add</button>
          <button class="btn btn-primary" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
