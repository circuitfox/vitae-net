@extends("layouts.app")
@section("title", "Vitae NET - Orders")
@section("content")
<div class="container col-md-8 col-md-offset-2">
  <? $orders = App\Order::all(); ?>
  @if ($orders->isEmpty())
    <div class="panel panel-default">
      @if (Auth::user()->isAdmin() || Auth::user()->isInstructor())
        <div class="panel-header">
          <div class="row">
            <h3 class="col-md-offset-2 col-md-8 text-center">No orders in the database. Add some?</h3>
          </div>
        </div>
        <div class="panel-body">
          <a href="{{ route('orders.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Orders</a>
        </div>
      @else
        <div class="panel-header">
          <div class="row">
            <h3 class="col-md-offset-2 col-md-8 text-center">No orders in the database.</h3>
          </div>
        </div>
      @endif
    </div>
  @else
    <div class="panel-group" id="orders" role="tablist">
      @foreach ($orders as $order)
        <div class="panel panel-default">
          <div class="panel-heading" role="tab">
            <div class="row">
              <div class="panel-title">
                <a class="accordion collapsed col-md-8" role="button" data-toggle="collapse" data-parent="#orders" data-target="#order{{ $order->id }}">
                  @include("partials.order.header", ["order" => $order])
                </a>
              </div>
              <div class="btn-toolbar col-md-4">
                <a href="/orders/{{ $order->id }}" class="btn btn-default h3">Details</a>
                @if (Auth::user()->isAdmin() || Auth::user()->isInstructor())
                  <a href="/orders/{{ $order->id }}/edit" class="btn btn-primary h3">Edit</a>
                  <button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#order-delete-modal" data-id="{{ $order->id }}">Delete</button>
                @endif
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
