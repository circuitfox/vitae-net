@extends("layouts.app")
@section("title", "Vitae NET Administration - Patients")
@section("content")
<div class="container col-md-8 col-md-offset-2">
  <? $patients = App\Patient::all(); ?>
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
            @include("partials/patient/body", ["patient" => $patient])
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @if(Auth::check())
    @if (Auth::user()->isAdmin())
      @include("partials/patient/delete-modal")
    @endif
  @endif
</div>
@endsection
