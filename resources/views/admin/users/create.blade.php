@extends("layouts.app")
@section("title", "Vitae NET Administration - Users")
@section("content")
<div class="container col-md-8 col-md-offset-2">
  <div class="panel">
    <div class="panel-default panel-heading">
      <h3>Create new user</h3>
    </div>
    <div class="panel-body">
      <div class="container">
        <form class="form-horizontal" method="POST" action="/users">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name" class="col-md-2 control-label">Name:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-md-2 control-label">Email Address:</label>
            <div class="col-md-6">
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="role" class="col-md-2 control-label">Role:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="role" name="role" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-2">
              <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
