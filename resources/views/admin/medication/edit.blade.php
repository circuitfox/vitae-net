@extends("layouts.app")
@section("title", "Medscanner Administration - Medication")
@section("content")
  <div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">Edit Medication</div>
      <div class="panel-body">
        <form id="medication-edit-form" class="form-horizontal" action="{{ route('medications.update', ['id' => $medication->medication_id]) }}" method="POST">
          {{ method_field('put') }}
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-md-2 control-label" for="name">Name:</label>
            <div class="col-md-6">
              <input class="form-control" type="text" name="name" value="{{ $medication->name or old('name') }}" id="med-name" required>
              @if ($errors->has('name'))
                <span class="help-block">
                  {{ $errors->first('name') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label" for="dosage_amount">Dosage:</label>
            <div class="col-md-3">
              <input class="form-control" type="number" name="dosage_amount" value="{{ $medication->dosage_amount or old('dosage_amount') }}" id="med-dosage-amount" required>
              @if ($errors->has('dosage_amount'))
                <span class="help-block">
                  {{ $errors->first('dosage_amount') }}
                </span>
              @endif
            </div>
            <div class="col-md-3">
              <input class="form-control" type="text" name="dosage_unit" value="{{ $medication->dosage_unit or old('dosage_unit') }}" id="med-dosage-unit" required>
              @if ($errors->has('dosage_unit'))
                <span class="help-block">
                  {{ $errors->first('dosage_unit') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label" for="comments">Comments:</label>
            <div class="col-md-6">
              <textarea class="form-control" rows="3" name="comments" id="med-comments" value="{{ $medication->comments or old('comments') }}"></textarea>
              @if ($errors->has('comments'))
                <span class="help-block">
                  {{ $errors->first('comments') }}
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
