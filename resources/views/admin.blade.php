@extends("layouts.app")
@section("title", "Medscanner Admin Page")
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
      <p><a class="btn btn-primary" href="{{ url('/users') }}">View Users</a>&nbsp;View and edit existing users.</p>
      <p><a class="btn btn-primary" href="{{ url('/users/create') }}">Create User</a>&nbsp;Create new user.</p>
      <p><a class="btn btn-primary" href="{{ url('/medications') }}">View Medications</a>&nbsp;View and edit existing medications.</p>
      <p><a class="btn btn-primary" href="{{ url('/medications/create') }}">Create Medication</a>&nbsp;Add new medication.</p>
      <p><a class="btn btn-primary" href="{{ url('/patients') }}">View Patients</a>&nbsp;View and edit existing patients.</p>
      <p><a class="btn btn-primary" href="{{ url('/patients/create') }}">Create Patient</a>&nbsp;Create new patient.</p>
    </div>
  </div>
</div>
@endsection
