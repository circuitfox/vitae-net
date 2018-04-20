@extends("layouts.app")
@section("title", "Vitae NET Admin Page")
@section("content")
<div class="container col-panel">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading"><h3>Administrator Dashboard</h3></div>
    <div class="panel-body">
      @if (Auth::user()->isAdmin() && Auth::user()->email === 'admin@example.com')
        <div class="alert alert-warning" role="alert">
          <span class="text-center"><strong>Admin:</strong> Remember to change your email address!</span>
        </div>
      @endif
      @if (Auth::user()->isAdmin())
        <h2>Users:</h2>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <a class="btn btn-primary" href="{{ url('/users') }}">View Users</a>
            <h4>View existing users.</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <a class="btn btn-primary" href="{{ url('/users/create') }}">Create User</a>
            <h4>Create new user.</h4>
          </div>
        </div>
      @endif

      <h2>Medications:</h2>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/signatures') }}">View Signatures</a>
          <h4>View student medication administration signatures.</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/medications') }}">View Medications</a>
          <h4>View and edit existing medications.</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/medications/create') }}">Create Medication</a>
          <h4>Add new medication.</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/medformatter') }}">Format Medication</a>
          <h4>Format medication data for QR codes.</h4>
        </div>
      </div>

      <h2>Patients:</h2>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/patients') }}">View Patients</a>
          <h4>View and edit existing patients.</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/patients/create') }}">Create Patient</a>
          <h4>Create new patient.</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/patientformatter') }}">Format Patient</a>
          <h4>Format patient data for QR codes.</h4>
        </div>
      </div>

      <h2>Orders:</h2>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/orders') }}">View Orders</a>
          <h4>View and edit existing orders.</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/orders/create') }}">Create Order</a>
          <h4>Create new order.</h4>
        </div>
      </div>

      <h2>Labs:</h2>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/labs') }}">View Labs</a>
          <h4>View and edit existing labs.</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-primary" href="{{ url('/labs/create') }}">Create Lab</a>
          <h4>Create new lab.</h4>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
