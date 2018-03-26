<div id="assessment" class="col-md-offset-1 col-md-10">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Assessment</h3>
    </div>
    @if (Auth::user()->isAdmin())
      <div class="col-md-offset-6 text-right">
        <a class="btn btn-success h3" href="/assessments/{{ $medical_record_number }}">View Assessments</a>
      </div>
    @else
      <div class="panel-body">
        <assessment-form id="assessment-form"
            :assessment="{{ json_encode($assessment) }}"
            mrn = "{{ $medical_record_number }}"
            route = "{{ route('assessments.update') }}">
        </assessment-form>
      </div>
    @endif
  </div>
</div>
