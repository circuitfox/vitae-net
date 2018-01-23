@extends ('layouts.app')

@section ('content')

<div class='col-sm-6'>
<h1> Create a New Patient </h1>

<form method='POST' action='/patients'>
  {{ csrf_field() }}

  <div class = 'form-group'>
    <label for='MRN'>MRN: </label>
    <input type='text' class='form-control' id='MRN' name='MRN'>
  </div>

  <div class = 'form-group'>
    <label for='fname'>First Name: </label>
    <input type='text' class='form-control' id='fname' name='fname'>
  </div>

  <div class = 'form-group'>
    <label for='lname'>Last Name: </label>
    <input type='text' class='form-control' id='lname' name='lname'>
  </div>

  <div class = 'form-group'>
    <label for='DOB'>Date of Birth: </label>
    <input type='date' class='form-control' id='DOB' name='DOB'>
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
