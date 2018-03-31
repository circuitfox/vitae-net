@extends("layouts.app")
@section("title", "Vitae NET Administration - Patients")
@section("content")
<div class="container col-panel">
  @if ($patients->isEmpty())
    <div class="panel panel-default">
      <div class="panel-header">
        <div class="row">
          <h3 class="text-center">No patients in the database.</h3>
        </div>
      </div>
      <div class="panel-body">
        @if (Auth::user()->isAdmin())
          <a href="{{ route('patients.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Patients</a>
        @endif
      </div>
    </div>
  @else
    <div class="list-group" id="patients" role="tablist">
      <div class="list-group-item">
        <div class="list-group-item-heading">
          @if (Auth::user()->isAdmin())
            <div class="pull-right">
              <a class="btn btn-success" href="{{ route('patients.create') }}">Add Patient</a>
            </div>
          @endif
          <h2>Patients</h2>
        </div>
      </div>
      @foreach ($patients as $patient)
        <div class="list-group-item clearfix">
          <div class="list-group-item-heading" role="tab">
            <div class="btn-toolbar pull-right">
              <a class="btn btn-default" href="{{ route('patients.show', ['id' => $patient->medical_record_number]) }}">Details</a>
              @if (Auth::user()->isAdmin())
                <a class="btn btn-primary" href="{{ route('patients.edit', ['id' => $patient->medical_record_number]) }}">Edit</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#patient-delete-modal" data-id="{{ $patient->medical_record_number }}">Delete</button>
              @endif
            </div>
            <a class="accordion collapsed item-title" role="button" data-toggle="collapse" data-parent="#patients" data-target="#patient{{ $patient->medical_record_number }}">
              @include("partials/patient/header", ["patient" => $patient])
            </a>
          </div>
          <div id="patient{{ $patient->medical_record_number }}" class="collapse" role="tabpanel">
            <div class="list-group-item-text">
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
  @if (Auth::user()->isAdmin())
    @include("partials/patient/delete-modal")
  @endif
</div>
@endsection
