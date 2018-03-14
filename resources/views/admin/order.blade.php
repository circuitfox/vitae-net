@extends("layouts.app")
@section("title", "Vitae NET - Order")
@section("content")
<div class="col-md-offset-1 col-md-10">
  <div id="order" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.order.header", ["order" => $order])
    </div>
    <div class="panel-body">
      @include("partials.order.body", ["order" => $order])
      <div class="col-md-7" style="height:500px;">
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
@endsection
