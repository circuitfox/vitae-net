@extends("layouts.app")
@section("title", "Vitae NET Administration - Account Settings")
@section("content")
<div class="container col-panel">
  <div class="panel">
    <div class="panel-heading panel-default">
      <h3>Edit User Account {{ $user->email }}</h3>
    </div>
    <div class="panel-body">
      <div class="container">
        <form class="form-horizontal" method="POST" action="/users/{{ $user->id }}">
          {{ method_field("PUT") }}
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name" class="col-md-2 control-label">Name:</label>
            @if (Auth::user()->isAdmin())
              <input type="hidden" class="form-control" id="name" name="name" required value="{{ $user->name }}">
              <div class="col-md-6" data-toggle="tooltip" title="Admin account name can't be changed">
                <input type="text" class="form-control" id="_name" name="_name" disabled value="{{ $user->name }}">
              </div>
            @else
              <div class="col-md-6">
                <input type="text" class="form-control" id="name" name="name" required value="{{ $user->name }}">
              </div>
            @endif
          </div>
          <div class="form-group">
            <label for="email" class="col-md-2 control-label">Email Address:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="email" name="email" required value="{{ $user->email }}">
            </div>
          </div>
          <div class="form-group">
            <label for="role" class="col-md-2 control-label">Role:</label>
              <input type="hidden" class="form-control" id="role" name="role" required value="{{ $user->role }}">
              <div class="col-md-6" data-toggle="tooltip" title="Role cannot be changed">
                <input type="text" class="form-control" id="_role" name="_role" disabled value="{{ $user->role }}">
              </div>
          </div>
          <div class="form-group">
            <label for="old_password" class="col-md-2 control-label">Old Password</label>
            <div class="col-md-6" data-toggle="tooltip" title="Type your old password in here">
              <input id="old_password" type="password" class="form-control" name="old_password">
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-md-2 control-label">Password</label>
            <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password">
            </div>
          </div>
          <div class="form-group">
            <label for="password_confirmation" class="col-md-2 control-label">Confirm Password:</label>
            <div class="col-md-6">
              <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-2 col-md-4">
              <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
