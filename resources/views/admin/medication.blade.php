@extends("layouts.app")
@section("title", "Vitae NET Administration - Medication")
@section("content")
<div class="col-panel">
  <div id="medication" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.medication.header", ["medication" => $medication])
    </div>
    <div class="panel-body">
      <div class="col-sm-8">
        @include("partials.medication.body", ["medication" => $medication])
      </div>
    </div>
  </div>
</div>
@endsection
