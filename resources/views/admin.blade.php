@extends("layouts.app")
@section("title", "Vitae NET Admin Page")
@section("content")
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading">Administrator Dashboard</div>
    <div class="panel-body">
      @if (Auth::user()->isAdmin() && Auth::user()->email === 'admin@example.com')
        <div class="alert alert-warning" role="alert">
          <span class="text-center"><strong>Admin:</strong> Remember to change your email address!</span>
        </div>
      @endif
      <p>Administrator options:</p>
      @if (Auth::user()->isAdmin())
        <p><a class="btn btn-primary" href="{{ url('/users') }}">View Users</a>&nbsp;View and edit existing users.</p>
        <p><a class="btn btn-primary" href="{{ url('/users/create') }}">Create User</a>&nbsp;Create new user.</p>
      @endif
      <p><a class="btn btn-primary" href="{{ url('/signatures') }}">View Signatures</a>&nbsp;View student medication administration signatures</p>
      <p><a class="btn btn-primary" href="{{ url('/medications') }}">View Medications</a>&nbsp;View and edit existing medications.</p>
      <p><a class="btn btn-primary" href="{{ url('/medications/create') }}">Create Medication</a>&nbsp;Add new medication.</p>
      <p><a class="btn btn-primary" href="{{ url('/medformatter') }}">Format Medication</a>&nbsp;Format medication data for QR/bar code.</p>
      <p><a class="btn btn-primary" href="{{ url('/patients') }}">View Patients</a>&nbsp;View and edit existing patients.</p>
      <p><a class="btn btn-primary" href="{{ url('/patients/create') }}">Create Patient</a>&nbsp;Create new patient.</p>
      <p><a class="btn btn-primary" href="{{ url('/patientformatter') }}">Format Patient</a>&nbsp;Format patient data for QR/bar code.</p>
      <p><a class="btn btn-primary" href="{{ url('/orders') }}">View Orders</a>&nbsp;View and edit existing orders.</p>
      <p><a class="btn btn-primary" href="{{ url('/orders/create') }}">Create Order</a>&nbsp;Create new order.</p>
      <p><a class="btn btn-primary" href="{{ url('/labs') }}">View Labs</a>&nbsp;View and edit existing labs.</p>
      <p><a class="btn btn-primary" href="{{ url('/labs/create') }}">Create Lab</a>&nbsp;Create new lab.</p>
    </div>
  </div>
</div>
@endsection
