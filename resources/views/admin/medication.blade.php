@extends("layouts.app")
@section("title", "Vitae NET Administration - Medication")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div id="medication" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.medication.header", ["medication" => $medication])
    </div>
    <div class="panel-body">
      @include("partials.medication.body", ["medication" => $medication])
    </div>
  </div>
</div>
@endsection
