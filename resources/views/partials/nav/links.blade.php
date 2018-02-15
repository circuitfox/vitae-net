<div>
  <ul class="nav navbar-nav">
  @if (!Auth::guest())
    <li><a href="{{ url('/patients') }}">Patients</a></li>
    <li><a href="{{ url('/orders') }}">Orders</a></li>
    <li><a href="{{ url('/labs') }}">Labs</a></li>
    <li><a href="{{ url('/medications') }}">Medications</a></li>
  @endif
    <li><a href="{{ url('/medication') }}">Scan Medication</a></li>
  </ul>
</div>
