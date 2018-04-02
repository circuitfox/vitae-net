@extends("layouts.app")
@section("title", "Vitae NET - Patients")
@section("content")
<div class="container col-md-8 col-md-offset-2">
  <? $patients = App\Patient::all(); ?>
  @if ($patients->isEmpty())
    <div class="panel panel-default">
      @if (Auth::user()->isPrivileged())
        <div class="panel-header">
          <div class="row">
            <h3 class="col-md-offset-2 col-md-8 text-center">No patients in the database. Add some?</h3>
          </div>
        </div>
        <div class="panel-body">
          <a href="{{ route('labs.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Patients</a>
        </div>
      @else
        <div class="panel-header">
          <div class="row">
            <h3 class="col-md-offset-2 col-md-8 text-center">No patients in the database.</h3>
          </div>
        </div>
      @endif
  @else
    <div class="panel-group" id="patients" role="tablist">
      @foreach ($patients as $patient)
        <div class="panel panel-default">
          <div class="panel-heading" role="tab">
            @if(Auth::check())
                <div class="row">
                  <div class="panel-title">
                    <a class="accordion collapsed col-md-8" role="button" data-toggle="collapse" data-parent="#patients" data-target="#patient{{ $patient->medical_record_number }}">
                      @include("partials/patient/header", ["patient" => $patient])
                    </a>
                  </div>
                  <div class="btn-toolbar col-md-4">
                    <a class="btn btn-default h3" href="{{ route('patients.show', ['id' => $patient->medical_record_number]) }}">Details</a>
                    @if (Auth::user()->isPrivileged())
                      <a class="btn btn-primary h3" href="{{ route('patients.edit', ['id' => $patient->medical_record_number]) }}">Edit</a>
                      <button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#patient-delete-modal" data-id="{{ $patient->medical_record_number }}">Delete</button>
                    @endif
                  </div>
                </div>
          @endif
        </div>
        <div id="patient{{ $patient->medical_record_number }}" class="panel-collapse collapse" role="tabpanel">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                @include("partials/patient/body", ["patient" => $patient])
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8">
                <h5><b><u>Bar Code</u></b></h5>
                <?php echo $patient->generateBarcode(); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4" style="margin-top:10px;">
                  <?php echo $patient->generateDownloadButton(); ?>
              </div>
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
