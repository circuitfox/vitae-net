@extends("layouts.app")
@section("title", "Vitae NET - Orders")
@section("content")
<div class="container col-md-8 col-md-offset-2">
  <? $orders = App\Order::all(); ?>
  @if ($orders->isEmpty())
    <div class="row">
      <h3 class="col-md-offset-2 col-md-8 text-center">No orders in the database. Add some?</h3>
    </div>
    <a href="{{ route('orders.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Orders</a>
  @else
    <div class="panel-group" id="orders" role="tablist">
      @foreach ($orders as $order)
        <div class="panel panel-default">
          <div class="panel-heading" role="tab">
            <div class="row">
              <a class="accordion collapsed col-md-8" role="button" data-toggle="collapse" data-parent="#orders" data-target="#order{{ $order->id }}">
                @include("partials.order.header", ["order" => $order])
              </a>
              <div class="btn-toolbar col-md-4">
                <a href="/orders/{{ $order->id }}/edit" class="btn btn-primary h3">Edit</a>
                <button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#order-delete-modal" data-id="{{ $order->id }}">Delete</button>
              </div>
            </div>
          </div>
          <div id="order{{ $order->id }}" class="panel-collapse collapse" role="tabpanel">
            <div class="panel-body">
              @include("partials.order.body", ["order" => $order])
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
  @include("partials.order.delete-modal")
</div>
@endsection
