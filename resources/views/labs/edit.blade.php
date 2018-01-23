@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-15 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{$lab-> name}}</div>
      <div class="panel-body">
        <div class="container">
          <form class="form-horizontal" id="lab-edit-form" method="POST" action="/labs/{{ $lab->id }}">
            {{ method_field("PUT") }}
            {{ csrf_field() }}
            <div class="form-group">
              <label class="col-md-2 control-label" for="name">Name:</label>
              <div class="col-md-6">
                <input id="first-name" class="form-control" type="text" name="name" value="{{ $lab->name }}" required>
                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="description">Description:</label>
              <div class="col-md-6">
                <input id="last-name" class="form-control" type="text" name="description" value="{{ $lab->description }}" required>
                @if ($errors->has('description'))
                  <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="patient_id">Patient Id:</label>
              <div class="col-md-6">
                <input id="dob" class="form-control" type="number" name="patient_id" value="{{ $lab->patient_id }}" required>
                @if ($errors->has('patient_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('patient_id') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          <div class="form-group">
            <div class="col-md-offset-2 col-md-4">
              <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
     </div>

     </div>
    </div>
   </div>
  </div>
</div>
@endsection
