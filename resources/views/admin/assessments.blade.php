@extends("layouts.app")
@section("title", "Vitae NET Administration - Patients")
@section("content")
<div class="container col-md-10 col-md-offset-1">
<h2>Patient Assessments:</h2>
  <div class="panel-group" id="assessments" role="tablist">
    @foreach ($assessments as $date=>$assessmentDay)
      <div class="panel panel-default">
        <div class="panel-heading" role="tab">
          <div class="row">
            <div class="panel-title">
              <a class="accordion collapsed col-md-8" role="button" data-toggle="collapse" data-parent="#assessments" data-target="#{{ $assessmentDay[0]['id'] }}">
                <h3>{{ $date }}</h3>
              </a>
            </div>
          </div>
        </div>
        <div id="{{ $assessmentDay[0]['id'] }}" class="panel-collapse collapse" role="tabpanel">
          <div class="panel-body">
            <div class="container">
              <div class="row">
                @foreach ($assessmentDay as $assessment)
                  <div class="col-md-5">
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
</div>
@endsection
