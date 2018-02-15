@extends('layouts/app')
@section('title', 'Vitae NET')
@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default" id="panel">
    <div class="panel-heading">Welcome</div>
    <div class="panel-body">
      <p>Select a module:</p>
      <div class="row">
        <a class="col-md-offset-3 col-md-2 btn btn-primary" href="{{ url('/home') }}">Orders</a>
        <a class="col-md-offset-1 col-md-2 btn btn-primary" href="{{ url('/medication') }}">Medication</a>
      </div>
    </div>
  </div>
</div>
@endsection
