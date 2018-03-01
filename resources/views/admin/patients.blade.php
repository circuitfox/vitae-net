@extends("layouts.app")
@section("title", "Vitae NET Administration - Patients")
@section("content")
<div class="container col-md-8 col-md-offset-2">
  <? $patients = App\Patient::all(); ?>
  @if ($patients->isEmpty())
    <div class="row">
      <h3 class="col-md-offset-2 col-md-8 text-center">No patients in the database. Add some?</h3>
    </div>
    <a href="{{ route('patients.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Patients</a>
  @else
    <div class="panel-group" id="patients" role="tablist">
      @foreach ($patients as $patient)
        <div class="panel panel-default">
          <div class="panel-heading" role="tab">
            @if(Auth::check())
              @if (Auth::user()->isAdmin())
                <div class="row">
                  <div class="panel-title">
                    <a class="accordion collapsed col-md-8" role="button" data-toggle="collapse" data-parent="#patients" data-target="#patient{{ $patient->medical_record_number }}">
                      @include("partials/patient/header", ["patient" => $patient])
                    </a>
                  </div>
                  <div class="btn-toolbar col-md-4">
                    <a class="btn btn-default h3" href="{{ route('patients.show', ['id' => $patient->medical_record_number]) }}">Details</a>
                    <a class="btn btn-primary h3" href="{{ route('patients.edit', ['id' => $patient->medical_record_number]) }}">Edit</a>
                    <button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#patient-delete-modal" data-id="{{ $patient->medical_record_number }}">Delete</button>
                  </div>
                </div>
              @else
                <a class="accordion collapsed" role="button" data-toggle="collapse"
                data-parent="#patients">
                @include("partials/patient/header", ["patient" => $patient])
              </a>
            @endif
          @endif
        </div>
        <div id="patient{{ $patient->medical_record_number }}" class="panel-collapse collapse" role="tabpanel">
          <div class="panel-body">
            <div class="col-sm-4">
              @include("partials/patient/body", ["patient" => $patient])
            </div>
            <div class="col-sm-4">
              <h5><b><u>Bar Code</u></b></h5>
              <?php
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                $patcode = "p " . $patient->medical_record_number;
                echo '<img src="data:image/png;base64,'. base64_encode($generator->getBarcode($patcode, $generator::TYPE_CODE_128, 3, 50)) .'" />';
              ?>
            </div>
            <div class="btn-toolbar col-sm-4" style="margin-left:0px;">
              <?php
                $patinfo = $patient->first_name . " " . $patient->last_name . " " . $patient->medical_record_number;
                echo '<a type="button" class="btn btn-primary" id="download" href="data:image/png;base64,'. base64_encode($generator->getBarcode($patcode, $generator::TYPE_CODE_128)) .'" download="'. $patinfo .'.png">
                Download Bar Code</a>';
              ?>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif
@if(Auth::check())
  @if (Auth::user()->isAdmin())
    @include("partials/patient/delete-modal")
  @endif
@endif
</div>
@endsection
