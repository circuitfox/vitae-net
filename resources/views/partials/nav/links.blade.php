<div>
  <ul class="nav navbar-nav">
  @if (!Auth::guest())
    <li><a href="{{ url('/patients') }}">Patients</a></li>
    @if (Auth::user()->isPrivileged())
      <li><a href="{{ url('/orders') }}">Orders</a></li>
      <li><a href="{{ url('/labs') }}">Labs</a></li>
      <li><a href="{{ url('/medications') }}">Medications</a></li>
    @endif
  @endif
    <li><a href="{{ url('/medication') }}">Scan Medication</a></li>
  </ul>
</div>
