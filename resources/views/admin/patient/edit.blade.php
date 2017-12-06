@extends("layouts.app")
@section("title", "Medscanner Administration - Patients")
@section("content")
  <div class="container col-md-8 col-md-offset-2">
    <div class="panel">
      <div class="panel-heading panel-default">
        <h3>Edit Patient Information</h3>
      </div>
      <div class="panel-body">
        <div class="container">
          <form class="form-horizontal" id="patient-edit-form" method="POST" action="/patients/{{ $patient->medical_record_number }}">
            {{ method_field("PUT") }}
            {{ csrf_field() }}
            <div class="form-group">
              <label class="col-md-2 control-label" for="first_name">First Name:</label>
              <div class="col-md-6">
                <input id="first-name" class="form-control" type="text" name="first_name" value="{{ $patient->first_name }}" required>
                @if ($errors->has('first_name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="last_name">Last Name:</label>
              <div class="col-md-6">
                <input id="last-name" class="form-control" type="text" name="last_name" value="{{ $patient->last_name }}" required>
                @if ($errors->has('last_name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="date_of_birth">Date of Birth:</label>
              <div class="col-md-6">
                <input id="dob" class="form-control" type="text" name="date_of_birth" value="{{ $patient->date_of_birth }}" required>
                @if ($errors->has('date_of_birth'))
                  <span class="help-block">
                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="sex">Sex:</label>
              <div class="col-md-6">
                <select id="sex" class="form-control" name="sex" form="patient-edit-form" value="{{ $patient->sex }}">
                  <option value="0">Female</option>
                  <option value="1">Male</option>
                </select>
                @if ($errors->has('sex'))
                  <span class="help-block">
                    <strong>{{ $errors->first('sex') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="physician">Physician:</label>
              <div class="col-md-6">
                <input id="physician" class="form-control" type="text" name="physician" value="{{ $patient->physician }}" required>
                @if ($errors->has('physician'))
                  <span class="help-block">
                    <strong>{{ $errors->first('physician') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="room">Room:</label>
              <div class="col-md-6">
                <input class="form-control" type="text" name="room" value="{{ $patient->room }}" required>
                @if ($errors->has('room'))
                  <span class="help-block">
                    <strong>{{ $errors->first('room') }}</strong>
                  </span>
                @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-2 col-md-4">
              <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
