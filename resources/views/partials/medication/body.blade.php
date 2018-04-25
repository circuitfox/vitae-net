<!-- medication info -->
<h5><b><u>Name:</u></b></h5>
<p>{{ $medication->primaryName() }}</p>
<h5><b><u>Dosage:</u></b></h5>
<p>{{ $medication->dosage_amount }} {{ $medication->dosage_unit }}</p>
@if ($medication->isCombo())
  <h5><b><u>Second Medication Name:</u></b></h5>
  <p>{{ $medication->secondaryName() }}</p>
  <h5><b><u>Dosage:</u></b></h5>
  <p>{{ $medication->second_amount }} {{ $medication->second_unit }}</p>
@elseif ($medication->isAmount())
  <h5><b><u>With:</u></b></h5>
  <p>{{ $medication->second_amount }} {{ $medication->second_unit }}</p>
@elseif ($medication->isIn())
  <h5><b><u>In:</u></b></h5>
  <p>{{ $medication->secondaryName() }}</p>
  <h5><b><u>Amount:</u></b></h5>
  <p>{{ $medication->second_amount }} {{ $medication->second_unit }}</p>
@endif
