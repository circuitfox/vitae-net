<!-- user info -->
<h5><b><u>First Name:</u></b></h5>
<p>{{ $patient->first_name }}</p>
<h5><b><u>Last Name:</u></b></h5>
<p>{{ $patient->last_name }}</p>
<h5><b><u>Date Of Birth:</u></b></h5>
<p>{{ $patient->date_of_birth }}</p>
<h5><b><u>Sex:</u></b></h5>
<p>{{ $patient->sex ? 'Male' : 'Female' }}</p>
<h5><b><u>Height:</u></b></h5>
<p>{{ $patient->height }}</p>
<h5><b><u>Weight:</u></b></h5>
<p>{{ $patient->weight }}</p>
<h5><b><u>Diagnosis:</u></b></h5>
<p>{{ $patient->diagnosis }}</p>
<h5><b><u>Allergies:</u></b></h5>
<p>{{ $patient->allergies }}</p>
<h5><b><u>Code Status:</u></b></h5>
<p>{{ $patient->code_status }}</p>
<h5><b><u>Physician:</u></b></h5>
<p>{{ $patient->physician }}</p>
<h5><b><u>Room:</u></b></h5>
<p>{{ $patient->room }}</p>
@if (Auth::user()->isAdmin())
  <a class="btn btn-success" href="/mars/create/{{ $patient->medical_record_number }}">Add prescription</a>
@endif
