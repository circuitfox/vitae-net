<!-- user info -->
<div class="row">
  <div class="col-md-2">
    <h5><b><u>Name:</u></b></h5>
    {{ $patient->first_name }} {{ $patient->last_name }}
  </div>
  <div class="col-md-2">
    <h5><b><u>Date Of Birth:</u></b></h5> {{ $patient->date_of_birth }}
  </div>
  <div class="col-md-2">
    <h5><b><u>Sex:</u></b></h5> {{ $patient->sex ? 'Male' : 'Female' }}
  </div>
  <div class="col-md-2">
    <h5><b><u>Height:</u></b></h5> {{ $patient->height }}
  </div>
  <div class="col-md-2">
    <h5><b><u>Weight:</u></b></h5> {{ $patient->weight }}
  </div>
</div>
<div class="row">
  <div class="col-md-2">
    <h5><b><u>Diagnosis:</u></b></h5> {{ $patient->diagnosis }}
  </div>
  <div class="col-md-2">
    <h5><b><u>Allergies:</u></b></h5> {{ $patient->allergies }}
  </div>
  <div class="col-md-2">
    <h5><b><u>Code Status:</u></b></h5> {{ $patient->code_status }}
  </div>
  <div class="col-md-2">
    <h5><b><u>Physician:</u></b></h5> {{ $patient->physician }}
  </div>
  <div class="col-md-2">
    <h5><b><u>Room:</u></b></h5> {{ $patient->room }}
  </div>
</div>
