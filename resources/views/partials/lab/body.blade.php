<div class="col-sm-3">
  <!-- lab info -->
  <h5><b><u>Name:</u></b></h5>
  <p>{{ $lab->name }}</p>
  <h5><b><u>Description:</u></b></h5>
  <p>{{ $lab->description }}</p>
  <h5><b><u>Patient MRN:</u></b></h5>
  @if($lab->patient_id == null)
    <p>Not assigned to patient</p>
  @else
    <p>{{ $lab->patient_id }}</p>
  @endif
</div>
