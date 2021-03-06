@extends("layouts.app")
@section("title", "Vitae NET Administration - Patient")
@section("content")
<div class="col-panel">
  <div id="patient" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.patient.header", ["patient" => $patient])
    </div>
    <div class="panel-body">
      @include("partials.patient.body", ["patient" => $patient])
      @if (Auth::user()->isPrivileged())
        <div class="row">
          <div class="col-md-6">
            <h5><b><u>Bar Code</u></b></h5>
            <?php echo $patient->generateBarcode() ?>
          </div>
        </div>
        @endif
    </div>
  </div>
</div>
@include("partials.mar", [
  "medical_record_number" => $patient->medical_record_number,
  "prescriptions" => $prescriptions,
  "statMeds" => $statMeds,
  "meds" => $meds,
  "complete" => $complete,
])
<div class="col-panel">
  <div class="panel-group" role="tablist">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab">
        <div class="panel-title">
          <a href="#labs" class="collapsed" role="button" data-toggle="collapse"><h3>Lab Results</h3></a>
        </div>
      </div>
      <div id="labs" class="panel-collapse collapse in" role="tabpanel">
        <lab-list id="lab-list"
          :labs="{{ json_encode($labs) }}"
          :lab-views="{{ json_encode($lab_views, JSON_FORCE_OBJECT) }}"
          name="{{ $patient->first_name }} {{ $patient->last_name }}"
          :mrn="{{ $patient->medical_record_number }}"
          route="{{ route('labs.index') }}"></lab-list>
      </div>
    </div>
  </div>
  <div class="panel-group" role="tablist">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab">
        <div class="panel-title">
          <a href="#orders" class="collapsed" role="button" data-toggle="collapse"><h3>Provider's Orders</h3></a>
        </div>
      </div>
      <div id="orders" class="panel-collapse collapse in" role="tabpanel">
        <order-list id="order-list"
          :orders="{{ json_encode($orders) }}"
          name="{{ $patient->first_name }} {{ $patient->last_name }}"
          :mrn="{{ $patient->medical_record_number }}"
          route="{{ route('orders.index') }}"></order-list>
      </div>
    </div>
  </div>
</div>
@include("partials.assessment", [
  "medical_record_number" => $patient->medical_record_number,
  "assessment" => $assessment,
])
@if(Auth::user()->isPrivileged())
  @include("partials.mar.delete-modal")
@endif
@endsection
