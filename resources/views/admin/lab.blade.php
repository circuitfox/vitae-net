@extends("layouts.app")
@section("title", "Vitae NET - Lab")
@section("content")
<div class="col-panel">
  <div id="reminder" class="alert alert-warning">
    <h4 class="text-center">Click "Scan Medication" above before administering medication.</h4>
  </div>
</div>
<div class="col-panel">
  <div id="lab" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.lab.header", ["lab" => $lab])
    </div>
    <div class="panel-body">
      @include("partials.lab.body", ["lab" => $lab])
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
