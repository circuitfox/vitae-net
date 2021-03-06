<div id="assessment" class="col-panel">
  <div class="panel panel-default">
    <div class="panel-heading">
      @if (Auth::user()->isPrivileged())
        <div class="pull-right">
          <a class="btn btn-success h3" href="/assessments/{{ $medical_record_number }}">View Assessments</a>
        </div>
      @endif
      <div class="row clearfix">
        <h3 class="col-md-6">Assessment</h3>
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
