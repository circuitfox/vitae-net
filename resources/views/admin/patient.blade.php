@extends("layouts.app")
Gk
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
        <?php echo $patient->generateBarcode() ?> 
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
<div class="col-md-12 panel panel-default">
  <div class="panel-heading">
    <h3>Medication Administration Record</h3>
  </div>
  <table  class="table">
    <tr>
      <th>Medication</th>
      <th>Instructions</th>
      <th>0700</th>
      <th>0800</th>
      <th>0900</th>
      <th>1000</th>
      <th>1100</th>
      <th>1200</th>
      <th>1300</th>
      <th>1400</th>
      <th>1500</th>
      <th>1600</th>
      <th>1700</th>
      <th>1800</th>
      <th>1900</th>
    </tr>
    @foreach($prescriptions as $prescription)
      <tr>
        <td> {{ $medNames[$prescription->medication_id]}} </td>
        <td> {{ $prescription->instructions}} </td>
        @for ($i = 0; $i < 13; $i++)
          @if ($prescription->given_at[$i] == 0)
            <td class="non-stat"></td>
          @else
            <td class="stat"></td>
          @endif
        @endfor
      </tr>
    @endforeach
    <tr> <td colspan="15" class="stat-header"><b> STAT/PRN </b></td></tr>
    @foreach($statMeds as $statMed)
      <tr>
        <td> {{ $medNames[$statMed->medication_id]}} </td>
        <td> {{ $statMed->instructions}} </td>
        @for ($i = 0; $i < 13; $i++)
          <td style="background-color: ##e2e2e2;"></td>
        @endfor
      </tr>
    @endforeach
  </table>
</div>

@endsection
