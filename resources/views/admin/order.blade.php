@extends("layouts.app")
@section("title", "Vitae NET - Order")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div id="order" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.order.header", ["order" => $order])
    </div>
    <div class="panel-body">
      @include("partials.order.body", ["order" => $order])
    </div>
  </div>
</div>
@endsection
