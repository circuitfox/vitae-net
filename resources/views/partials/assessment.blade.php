<div id="assessment" class="col-md-offset-1 col-md-10">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="row">
        <h3 class="col-md-6">Assessment</h3>
        @if (Auth::user()->isAdmin() || Auth::user()->isInstructor())
          <div class="col-md-6 text-right">
            <a class="btn btn-success h3" href="/assessments/{{ $medical_record_number }}">View Assessments</a>
          </div>
        @endif
      </div>
    </div>
    <div class="panel-body">
      <assessment-form id="assessment-form"
        :assessment="{{ json_encode($assessment) }}"
        :errors="{{ json_encode($errors->getMessages()) }}"
        mrn="{{ $medical_record_number }}"
        route="{{ route('assessments.update') }}">
      </assessment-form>
    </div>
  </div>
</div>
