<div class="collapse navbar-collapse">
@if (Auth::guest())
  <form class="navbar-form navbar-right" id="login-form" action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <input type="text" class="form-control" id="user" name="user" placeholder="Administrator Username">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Sign in</button>
  </form>
@else
  <div class="navbar-right">
    <p class="navbar-text">
      <span class="glyphicon glyphicon-user"></span>
      <a class="navbar-link" href="/admin">{{ Auth::user()->name }}</a>
    </p>
    <div class="col-md-2"></div>
  </div>
@endif
</div>
