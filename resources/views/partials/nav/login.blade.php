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
  <a href="/admin">{{ Auth::user()->name }}</a>
@endif
</div>
