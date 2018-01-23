@extends ('layouts.app')

@section ('content')

<div class='col-sm-6'>
<h1> Create a New Patient </h1>

<form method='POST' action='/patients'>
  {{ csrf_field() }}

  <div class = 'form-group'>
    <label for='medical_record_number'>medical_record_number: </label>
    <input type='text' class='form-control' id='medical_record_number' name='medical_record_number'>
  </div>

  <div class = 'form-group'>
    <label for='first_name'>First Name: </label>
    <input type='text' class='form-control' id='first_name' name='first_name'>
  </div>

  <div class = 'form-group'>
    <label for='last_name'>Last Name: </label>
    <input type='text' class='form-control' id='last_name' name='last_name'>
  </div>

  <div class = 'form-group'>
    <label for='date_of_birth'>Date of Birth: </label>
    <input type='date' class='form-control' id='date_of_birth' name='date_of_birth'>
  </div>

  <div class = 'form-group'>
    <label for='sex'>Sex: </label>
    <input type='text' class='form-control' id='sex' name='sex'>
  </div>

  <div class = 'form-group'>
    <label for='height'>Height: </label>
    <input type='text' class='form-control' id='height' name='height'>
  </div>

  <div class = 'form-group'>
    <label for='weight'>Weight: </label>
    <input type='text' class='form-control' id='weight' name='weight'>
  </div>

  <div class = 'form-group'>
    <label for='diagnosis'>Diagnosis: </label>
    <input type='text' class='form-control' id='diagnosis' name='diagnosis'>
  </div>

  <div class = 'form-group'>
    <label for='allergies'>Allergies: </label>
    <input type='text' class='form-control' id='allergies' name='allergies'>
  </div>

  <div class = 'form-group'>
    <label for='physician'>Physician: </label>
    <input type='text' class='form-control' id='physician' name='physician'>
  </div>

  <div class = 'form-group'>
    <label for='code_status'>Code Status: </label>
    <input type='text' class='form-control' id='code_status' name='code_status'>
  </div>

  <button type='submit' class='btn btn-primary'>Submit</button>
</form>

</div>

@endsection
