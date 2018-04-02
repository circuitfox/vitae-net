<div id="mar" class="col-md-offset-1 col-md-10">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="col-md-6">Medication Administration Record</h3>
      @if (Auth::user()->isPrivileged())
        <div class="col-md-offset-4 text-right">
          <a class="btn btn-success h3" href="/mars/create/{{ $medical_record_number }}">Add Prescription</a>
        </div>
      @endif
    </div>
    @if ($prescriptions->isEmpty() && $statMeds->isEmpty())
      <div class="panel-body">
        <h5 class="text-center text-muted">No entries in the MAR</h5>
      </div>
    @else
      <table class="table-hover">
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
          @if (Auth::user()->isPrivileged())
            <th>Edit</th>
          @endif
        </tr>
        @foreach($prescriptions as $prescription)
          <tr is="mar-entry"
              :meds="{{ json_encode($meds) }}"
              :mar-entry="{{ $prescription->toJsonArray() }}"
              :is-admin="{{ json_encode(Auth::user()->isAdmin()) }}"
              route="{{ route('mars.update', ['id' => $prescription->id]) }}">
          </tr>
        @endforeach
        @if (!$statMeds->isEmpty())
          <tr> <td colspan="16" class="stat-header"><b> STAT/PRN </b></td></tr>
          @foreach($statMeds as $statMed)
            <tr is="mar-entry"
                :meds="{{ json_encode($meds) }}"
                :mar-entry="{{ $statMed->toJsonArray() }}"
                :is-admin="{{ json_encode(Auth::user()->isAdmin()) }}"
                route="{{ route('mars.update', ['id' => $statMed->id]) }}">
            </tr>
          @endforeach
        @endif
      </table>
    @endif
  </div>
</div>
