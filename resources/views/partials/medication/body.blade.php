<div class="container">
  <div class="col-sm-4">
    <!-- medication info -->
    <h5><b><u>Name:</u></b></h5>
    <p>{{ $medication->name }}</p>
    <h5><b><u>Dosage:</u></b></h5>
    <p>{{ $medication->dosage_amount }} {{ $medication->dosage_unit }}</p>
    <h5><b><u>Instructions:</u></b></h5>
    <p>{{ $medication->instructions }}</p>
    <h5><b><u>Comments:</u></b></h5>
    <p>{{ $medication->comments }}</p>
    <h5><b><u>Stat:</u></b></h5>
    <p>{{ $medication->stat ? 'True' : 'False' }}</p>
  </div>
</div>
