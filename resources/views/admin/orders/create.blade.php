@extends("layouts.app")
@section("title", "Vitae NET - Add Order")
@section("content")
<div class="container col-panel">
  <div class="panel">
    <div class="panel-default panel-heading">
      <h3>Create new order</h3>
    </div>
    <div class="panel-body">
      <div class="container">
        <form class="form-horizontal" method="POST" action="/orders" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name" class="col-md-2 control-label">Name:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="name" name="name" required>
              @if ($errors->has('name'))
                <span class="help-block">
                  {{ $errors->first('name') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="description" class="col-md-2 control-label">Description:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="description" name="description" required>
              @if ($errors->has('description'))
                <span class="help-block">
                  {{ $errors->first('description') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="doc" class="col-md-2 control-label">Orders document:</label>
            <div class="col-md-6">
              <input type="file" id="doc" name="doc" required>
              <p class="help-block">Upload the desired file here</p>
              @if ($errors->has('doc'))
                <span class="help-block">
                  {{ $errors->first('doc') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="patient_id" class="col-md-2 control-label">Patient:</label>
            <div class="col-md-6">
              <select id="patient_id" class="form-control" name="patient_id">
                <option value="">No patient</option>
                @foreach ($patients as $patient)
                  <option value='{{ $patient->medical_record_number }}'>{{ $patient->last_name}}, {{ $patient->first_name }} ({{$patient->medical_record_number}})</option>
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
            <label for="completed" class="col-md-2 control-label">Completed:</label>
            <div class="col-md-6">
              <select id="completed" class="form-control" name="completed">
                <option value="0">No</option>
                <option value="1">Yes</option>
              </select>
              @if ($errors->has('completed'))
                <span class="help-block">
                  {{ $errors->first('completed') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-2 col-md-4">
              <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
