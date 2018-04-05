@extends("layouts.app")
@section("title", "Vitae NET Administration - Patients")
@section("content")
  <div class="container col-panel">
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
                <select id="sex" class="form-control" name="sex" form="patient-edit-form">
                    @foreach ([0, 1] as $key)
                      @if ($patient->sex == $key)
                        <option value="{{ $key }}" selected>{{ $key ? 'Male' : 'Female' }}</option>
                      @else
                        <option value="{{ $key }}">{{ $key ? 'Male' : 'Female' }}</option>
                      @endif
                    @endforeach
                </select>
                @if ($errors->has('sex'))
                  <span class="help-block">
                    <strong>{{ $errors->first('sex') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="height">Height:</label>
              <div class="col-md-6">
                <input id="height" class="form-control" type="text" name="height" value="{{ $patient->height }}" required>
                @if ($errors->has('height'))
                  <span class="help-block">
                    <strong>{{ $errors->first('height') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="physician">Weight:</label>
              <div class="col-md-6">
                <input id="weight" class="form-control" type="text" name="weight" value="{{ $patient->weight }}" required>
                @if ($errors->has('weight'))
                  <span class="help-block">
                    <strong>{{ $errors->first('weight') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="diagnosis">Diagnosis:</label>
              <div class="col-md-6">
                <input id="diagnosis" class="form-control" type="text" name="diagnosis" value="{{ $patient->diagnosis }}" required>
                @if ($errors->has('diagnosis'))
                  <span class="help-block">
                    <strong>{{ $errors->first('diagnosis') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="allergies">Allergies:</label>
              <div class="col-md-6">
                <input id="allergies" class="form-control" type="text" name="allergies" value="{{ $patient->allergies }}" required>
                @if ($errors->has('allergies'))
                  <span class="help-block">
                    <strong>{{ $errors->first('allergies') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label" for="code_status">Code Status:</label>
              <div class="col-md-6">
                <select id="code_status" class="form-control" name="code_status" form="patient-edit-form">
                  @if ($patient->code_status === null)
                    <option value="" selected></option>
                  @else
                    <option value=""></option>
                  @endif
                  @foreach (App\Patient::CODE_STATUSES as $status)
                    @if ($patient->code_status === $status)
                      <option value="{{ $status }}" selected>{{ $status }}</option>
                    @else
                      <option value="{{ $status }}">{{ $status }}</option>
                    @endif
                  @endforeach
                </select>
                @if ($errors->has('code_status'))
                  <span class="help-block">
                    <strong>{{ $errors->first('code_status') }}</strong>
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
