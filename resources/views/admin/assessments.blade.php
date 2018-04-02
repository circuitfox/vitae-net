@extends("layouts.app")
@section("title", "Vitae NET Administration - Patients")
@section("content")
<div class="container col-panel">
  @if ($assessments->isEmpty())
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <h3>No assessments for {{ $patient->first_name }} {{ $patient->last_name }}</h3>
        </div>
      </div>
    </div>
  @else
    <div class="list-group" id="assessments" role="tablist">
      <div class="list-group-item">
        <div class="list-group-item-heading">
          <h2>Assessments for {{ $patient->first_name }} {{ $patient->last_name }}</h2>
        </div>
      </div>
      @foreach ($assessments as $date=>$assessmentDay)
        <div class="list-group-item">
          <div class="list-group-item-heading" role="tab">
            <a class="accordion collapsed item-title" role="button" data-toggle="collapse" data-parent="#assessments" data-target="#{{ $assessmentDay[0]['id'] }}">
                <h3>{{ $date }}</h3>
            </a>
          </div>
          <div id="{{ $assessmentDay[0]['id'] }}" class="collapse" role="tabpanel">
            <div class="list-group-item-text">
              <div class="container">
                <div class="row">
                  @foreach ($assessmentDay as $assessment)
                    <div class="col-md-6">
                      @include("partials/assessments/body", ["assessment" => $assessment])
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
