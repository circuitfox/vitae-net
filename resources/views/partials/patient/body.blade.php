<div class="container">
  <div class="col-sm-4">
    <!-- user info -->
    <h5><b><u>First Name:</u></b></h5>
    <p>{{ $patient->first_name }}</p>
    <h5><b><u>Last Name:</u></b></h5>
    <p>{{ $patient->last_name }}</p>
    <h5><b><u>Date Of Birth:</u></b></h5>
    <p>{{ $patient->date_of_birth }}</p>
    <h5><b><u>Sex:</u></b></h5>
    <p>{{ $patient->sex ? 'Male' : 'Female' }}</p>
    <h5><b><u>Physician</u></b></h5>
    <p>{{ $patient->physician }}</p>
    <h5><b><u>Room:</u></b></h5>
    <p>{{ $patient->room }}</p>
  </div>
</div>
