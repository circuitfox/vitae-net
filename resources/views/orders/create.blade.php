@extends ('layouts.app')

@section ('content')

<div class='col-sm-6'>
<h1> Create a New Order </h1>

<form method='POST' action='/orders' enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class = 'form-group'>
    <label for='name'>Name: </label>
    <input type='text' class='form-control' id='name' name='name'>
  </div>

  <div class = 'form-group'>
    <label for='doc'>Orders document: </label>
    <input type='file' id='doc' name='doc'>
    <p class='help-block'>Upload the desired file here</p>
  </div>

    <div class = 'form-group'>
    <label for='description'>Description: </label>
    <input type='text' class='form-control' id='description' name='description'>
  </div>

  <div class = 'form-group'>
    <label for='patient_id'>Patient ID: </label>
    <input type='text' class='form-control' id='patient_id' name='patient_id'>
  </div>

  <div class = 'form-group'>
    <label for='completed'>Completed: </label>
  <div class="checkbox">
  <label><input type="checkbox" value=1 id='completed' name='completed'>Yes</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value=0  id='completed' name='completed'>No</label>
</div>
</div>



  <button type='submit' class='btn btn-primary'>Submit</button>
</form>

</div>

@endsection
