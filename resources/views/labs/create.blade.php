@extends ('layouts.app')

@section ('content')

<div class='col-sm-6'>
<h1> Create New Lab Results</h1>

<form method='POST' action='/labs' enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class = 'form-group'>
    <label for='name'>Name (no spaces): </label>
    <input type='text' class='form-control' id='name' name='name'>
  </div>

  <div class = 'form-group'>
    <label for='doc'>Lab results document: </label>
    <input type='file' id='doc' name='doc'>
    <p class='help-block'>Upload the desired pdf here</p>
  </div>

  <div class = 'form-group'>
    <label for='description'>Description: </label>
    <input type='text' class='form-control' id='description' name='description'>
  </div>

  <div class = 'form-group'>
    <label for='patient_id'>Patient ID: </label>
    <input type='text' class='form-control' id='patient_id' name='patient_id'>
  </div>


  <button type='submit' class='btn btn-primary'>Submit</button>
</form>

</div>

@endsection
