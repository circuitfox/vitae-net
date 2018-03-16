@extends("layouts.app")
@section("title", "Vitae NET - Edit Order")
@section("content")
  <div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">Edit Order</div>
      <div class="panel-body">
        <form id="order-edit-form" class="form-horizontal" action="{{ route('orders.update', ['id' => $order->id]) }}" method="POST">
          {{ method_field('put') }}
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-md-2 control-label" for="name">Name:</label>
            <div class="col-md-6">
              <input class="form-control" type="text" name="name" value="{{ $order->name or old('name') }}" id="name" required>
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
              <input class="form-control" type="text" name="description" value="{{ $order->description or old('description') }}" id="description" required>
              @if ($errors->has('description'))
                <span class="help-block">
                  {{ $errors->first('description') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="patient_id" class="col-md-2 control-label">Patient:</label>
            <div class="col-md-6">
              <select id="patient_id" class="form-control" name="patient_id">
                <option value="" selected="selected">No patient</option>
                @foreach ($patients as $patient)
                  @if ($order->patient_id == $patient->medical_record_number)
                    <option value="{{$patient->medical_record_number}}" selected="selected">{{ $patient->first_name }} {{ $patient->last_name}}</option>
                  @else
                    <option value="{{$patient->medical_record_number}}">{{ $patient->first_name }} {{ $patient->last_name}}</option>
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
            <label class="col-md-2 control-label" for="completed">Completed:</label>
            <div class="col-md-6">
              <select id="completed" class="form-control" name="completed" form="order-edit-form">
                 @foreach([0, 1] as $key)
                  @if ($order->completed == $key)
                    <option value="{{ $key }}" selected="selected">{{ $key ? 'Yes' : 'No' }}</option>
                  @else
                    <option value="{{ $key }}">{{ $key ? 'Yes' : 'No' }}</option>
                  @endif
                 @endforeach
              </select>
              @if ($errors->has('completed'))
                <span class="help-block">
                  <strong>{{ $errors->first('completed') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox col-md-offset-2 col-md-2">
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
