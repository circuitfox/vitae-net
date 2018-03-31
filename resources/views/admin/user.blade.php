@extends("layouts.app")
@section("title", "Vitae NET Administration - User")
@section("content")
<div class="col-panel">
  <div id="medication" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.user.header", ["user" => $user])
    </div>
    <div class="panel-body">
      @include("partials.user.body", ["user" => $user])
    </div>
  </div>
</div>
@endsection
