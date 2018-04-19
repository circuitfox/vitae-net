@extends("layouts.app")
@section("title", "Vitae NET Administration - MAR")
@section("content")
<div class="col-panel">
  <div class="alert alert-info">
    <h4>Viewing MAR for {{ $patient->first_name }} {{ $patient->last_name }} (MRN: {{ $patient->medical_record_number }})</h4>
  </div>
</div>
@include("partials.mar", [
  "medical_record_number" => $patient->medical_record_number,
  "prescriptions" => $prescriptions,
  "statMeds" => $statMeds,
  "meds" => $meds,
])
@endsection
