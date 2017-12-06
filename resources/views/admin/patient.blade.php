@extends("layouts.app")
@section("title", "Medscanner Administration - Patient")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div id="patient" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.patient.header", ["patient" => $patient])
    </div>
    <div class="panel-body">
      @include("partials.patient.body", ["patient" => $patient])
    </div>
  </div>
</div>
@endsection
