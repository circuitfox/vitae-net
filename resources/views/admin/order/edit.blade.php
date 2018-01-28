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
            <label class="col-md-2 control-label" for="patient_id">Patient ID:</label>
            <div class="col-md-6">
              <input class="form-control" type="text" name="patient_id" id="patient_id" value="{{ $order->patient_id or old('patient_id') }}">
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
              <select id="completed" class="form-control" name="completed" form="order-edit-form" value="{{ $order->completed }}">
                <option value="0">No</option>
                <option value="1">Yes</option>
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
