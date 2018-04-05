@extends("layouts.app")
@section("title", "Vitae NET - Edit Lab")
@section("content")
  <div class="col-panel">
    <div class="panel panel-default">
      <div class="panel-heading"><h3>Edit Lab Result</h3></div>
      <div class="panel-body">
        <form id="lab-edit-form" class="form-horizontal" action="{{ route('labs.update', ['id' => $lab->id]) }}" method="POST" enctype="multipart/form-data">
          {{ method_field('put') }}
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-md-2 control-label" for="name">Name:</label>
            <div class="col-md-6">
              <input class="form-control" type="text" name="name" value="{{ $lab->name or old('name') }}" id="name" required>
              @if ($errors->has('name'))
                <span class="help-block">
                  {{ $errors->first('name') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label" for="description">Description:</label>
            <div class="col-md-6">
              <input class="form-control" type="text" name="description" value="{{ $lab->description or old('description') }}" id="description" required>
              @if ($errors->has('description'))
                <span class="help-block">
                  {{ $errors->first('description') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="doc" class="col-md-2 control-label">Lab result document:</label>
            <div class="col-md-6">
              <input type="file" id="doc" name="doc">
              <p class="help-block">Upload a different file here, if needed.</p>
            </div>
          </div>
          <div class="form-group">
            <label for="patient_id" class="col-md-2 control-label">Patient:</label>
            <div class="col-md-6">
              <select id="patient_id" class="form-control" name="patient_id">
                @if ($lab->patient_id === null)
                  <option value="" selected>No patient</option>
                @else
                  <option value="">No patient</option>
                @endif
                @foreach ($patients as $patient)
                  @if ($lab->patient_id == $patient->medical_record_number)
                    <option value="{{ $patient->medical_record_number }}" selected>
                      {{ $patient->first_name }} {{ $patient->last_name}} ({{$patient->medical_record_number}})
                    </option>
                  @else
                    <option value="{{ $patient->medical_record_number }}">
                      {{ $patient->last_name}}, {{ $patient->first_name }} ({{$patient->medical_record_number}})
                    </option>
                  @endif
                @endforeach
              </select>
              @if ($errors->has('patient_id'))
                <span class="help-block">
                  {{ $errors->first('patient_id') }}
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
        </div>
      </div>
    </div>
  @endsection
