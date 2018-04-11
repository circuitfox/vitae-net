@extends("layouts.app")
@section("title", "Vitae NET - Order")
@section("content")
<div class="col-panel">
  <div id="reminder" class="alert alert-warning">
    <h4 class="text-center">Click "Scan Medication" above before administering medication.</h4>
  </div>
</div>
<div class="col-panel">
  <div id="order" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.order.header", ["order" => $order])
    </div>
    <div class="panel-body">
      @if (session('complete'))
        <div id="completed-success" class="alert alert-success alert-dismissable" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          {{ session('complete') }}
        </div>
      @endif
      @include("partials.order.body", ["order" => $order])
      <div class="col-md-9" style="height:500px;">
        <object data="{{ $pdf }}" type="application/pdf" width="100%" height="100%">
          <iframe src="{{ $pdf }}" width="100%" height="100%" style="border:none;">
            This browser does not support embedding PDF documents. Please download
            the PDF to view it. <a href="{{ $pdf }}">Download PDF</a>
          </iframe>
        </object>
      </div>
    </div>
  </div>
</div>
@include("partials.order.complete-modal")
@endsection
