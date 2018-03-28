<div>
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
</div>
