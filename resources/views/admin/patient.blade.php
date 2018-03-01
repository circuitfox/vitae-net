@extends("layouts.app")
@section("title", "Vitae NET Administration - Patient")
@section("content")
<div class="col-md-offset-2 col-md-4">
  <div id="patient" class="panel panel-default">
    <div class="panel-heading">
      @include("partials.patient.header", ["patient" => $patient])
    </div>
    <div class="panel-body">
      <div class="col-sm-4">
        @include("partials.patient.body", ["patient" => $patient])
      </div>
      <div class="col-sm-4">
        <h5><b><u>Bar Code</u></b></h5>
        <?php
          $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
          $patcode = "p " . $patient->medical_record_number;
          echo '<img src="data:image/png;base64,'. base64_encode($generator->getBarcode($patcode, $generator::TYPE_CODE_128, 3, 50)) .'" />';
        ?>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4">
  <div class="panel-group" role="tablist">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab">
        <h3 class="panel-title">
          <a href="#labs" class="collapsed" role="button" data-toggle="collapse">Lab Results</a>
        </h3>
      </div>
      <div id="labs" class="panel-collapse collapse in" role="tabpanel">
        <ul class="list-group">
          @foreach ($labs as $lab)
            <a class="list-group-item" href="{{ route('labs.show', ['id' => $lab->id]) }}">{{ $lab->name }}</a>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  <div class="panel-group" role="tablist">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab">
        <h3 class="panel-title">
          <a href="#orders" class="collapsed" role="button" data-toggle="collapse">Provider's Orders</a>
        </h3>
      </div>
      <div id="orders" class="panel-collapse collapse in" role="tabpanel">
        <ul class="list-group">
          @foreach ($orders as $order)
            @if ($order->completed)
              <a class="list-group-item list-group-item-success" href="{{ route('orders.show', ['id' => $order->id]) }}">
                {{ $order->name }}
              </a>
            @else
              <a class="list-group-item list-group-item-danger" href="{{ route('orders.show', ['id' => $order->id]) }}">
                {{ $order->name }}
              </a>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
