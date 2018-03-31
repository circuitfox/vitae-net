@extends("layouts.app")
@section("title", "Vitae NET - Orders")
@section("content")
<div class="container col-panel">
  @if ($orders->isEmpty())
    <div class="panel panel-default">
      <div class="panel-header">
        <div class="row">
          <h3 class="text-center">No orders in the database.</h3>
        </div>
      </div>
      <div class="panel-body">
        @if (Auth::user()->isAdmin())
          <a href="{{ route('orders.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Orders</a>
        @endif
      </div>
    </div>
  @else
    <div class="list-group" id="orders" role="tablist">
      <div class="list-group-item">
        <div class="list-group-item-heading">
          @if (Auth::user()->isAdmin())
            <div class="pull-right">
              <a class="btn btn-success" href="{{ route('orders.create') }}">Add Order</a>
            </div>
          @endif
          <h2>Orders</h2>
        </div>
      </div>
      @foreach ($orders as $order)
        <div class="list-group-item clearfix">
          <div class="list-group-item-heading" role="tab">
            <div class="btn-toolbar pull-right">
              <a href="/orders/{{ $order->id }}" class="btn btn-default">Details</a>
              @if (Auth::user()->isAdmin())
                <a href="/orders/{{ $order->id }}/edit" class="btn btn-primary">Edit</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#order-delete-modal" data-id="{{ $order->id }}">Delete</button>
              @endif
            </div>
            <a class="accordion collapsed item-title" role="button" data-toggle="collapse" data-parent="#orders" data-target="#order{{ $order->id }}">
              @include("partials.order.header", ["order" => $order])
            </a>
          </div>
          <div id="order{{ $order->id }}" class="collapse" role="tabpanel">
            <div class="list-group-item-text">
              @include("partials.order.body", ["order" => $order])
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@if (Auth::user()->isAdmin())
  @include("partials.order.delete-modal")
@endif
@endsection
