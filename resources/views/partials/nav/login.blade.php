<div class="collapse navbar-collapse">
@if (Auth::guest())
  <form class="navbar-form navbar-right" id="login-form" action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <input type="text" class="form-control" id="email" name="email" placeholder="Administrator Email">
      @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
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
      <span class="glyphicon glyphicon-user"></span>
      <a class="navbar-link" href="{{ url('/admin') }}">{{ Auth::user()->name }}</a>
    </div>
    <div class="navbar-text">
      <span class="glyphicon glyphicon-log-out"></span>
      <a class="navbar-link" href="{{ url('/logout') }}">Logout</a>
    </div>
  </div>
@endif
</div>
