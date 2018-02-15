@extends("layouts.app")
@section("title", "Vitae NET - Lab")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div id="lab" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.lab.header", ["lab" => $lab])
    </div>
    <div class="panel-body">
      @include("partials.lab.body", ["lab" => $lab])
    </div>
  </div>
</div>
@endsection
