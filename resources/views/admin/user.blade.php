@extends("layouts.app")
@section("title", "Medscanner Administration - User")
@section("content")
<div class="col-md-offset-2 col-md-8">
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
