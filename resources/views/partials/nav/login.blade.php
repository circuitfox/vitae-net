<div>
@if (Auth::guest())
  <form class="navbar-form navbar-right" id="login-form" action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <input type="text" class="form-control" id="name" name="name" placeholder="Username">
      @if ($errors->has('name'))
        <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
      @endif
    </div>
    <button type="submit" class="btn btn-default">Sign in</button>
  </form>
@else
  <div class="navbar-right">
    <div class="navbar-text">
      <span class="glyphicon glyphicon-cog"></span>
      <a class="navbar-link" href="{{ url('/users/' . Auth::user()->id . '/edit') }}">Settings</a>
    </div>
    <div class="navbar-text">
      <span class="glyphicon glyphicon-user"></span>
      <!-- TODO: should redirect to /home -->
      <a class="navbar-link" href="{{ url('/home') }}">{{ Auth::user()->name }}</a>
    </div>
    <div class="navbar-text">
      <span class="glyphicon glyphicon-log-out"></span>
      <a class="navbar-link" href="{{ url('/logout') }}">Logout</a>
    </div>
  </div>
@endif
</div>
