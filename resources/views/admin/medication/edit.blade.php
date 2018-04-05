@extends("layouts.app")
@section("title", "Vitae NET Administration - Medication")
@section("content")
  <div class="col-panel">
    <div class="panel panel-default">
      <div class="panel-heading"><h3>Edit Medication</h3></div>
      <div class="panel-body">
        <form id="medication-edit-form" class="form-horizontal" action="{{ route('medications.update', ['id' => $medication->medication_id]) }}" method="POST">
          {{ method_field('put') }}
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-md-2 control-label" for="name">Name:</label>
            <div class="col-md-6">
              <input class="form-control" type="text" name="name" value="{{ old('name', $medication->primaryName()) }}" id="med-name" required>
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
              <input class="form-control" type="number" name="dosage_amount" step="0.01" value="{{ number_format(old('dosage_amount', $medication->dosage_amount), 2) }}" id="med-dosage-amount" required>
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
            <label class="col-md-2 control-label" for="second_type"
                   data-toggle="tooltip" data-placement="right" title="
Some medications contain extra infromation besides just their name and dosage.
These can be divided into three types:

'and' - There is a secondary drug with its own name and dosage

'with' - There is a separate quantity e.g. 10mL with 100 units/mL

'in' - The medication is in some medium, such as 10mL saline

If none of these conditions apply, leave these fields blank.">
              Second Type:
            </label>
            <div class="col-md-6">
              <select id="med-second-type" class="form-control" name="second_type" form="medication-form">
                @if ($medication->second_type === null)
                  <option value="" selected>none</option>
                @else
                  <option value="">none</option>
                @endif
                @foreach (App\Medication::SECOND_TYPES as $key)
                  <option value="{{ App\Medication::type_option($key) }}" selected="{{ old('second_type', $medication->second_type) === $key ? 'selected' : '' }}">
                @endforeach
              </select>
              @if ($errors->has('second_type'))
                <span class="help-block">
                  {{ $errors->first('second_type') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label" for="secondary_name">Name:</label>
            <div class="col-md-6">
              <input class="form-control" type="text" name="secondary_name" value="{{ old('seecondary_name', $medication->secondaryName()) }}" id="med-secondary-name">
              @if ($errors->has('secondary_name'))
                <span class="help-block">
                  {{ $errors->first('secondary_name') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label" for="second_amount">Amount:</label>
            <div class="col-md-3">
              @if (old('second_amount', $medication->second_amount) == null)
                <input class="form-control" type="number" name="second_amount" step="0.01" value="" id="med-second-amount">
              @else
                <input class="form-control" type="number" name="second_amount" step="0.01" value="{{ number_format(old('second_amount', $medication->second_amount), 2) }}" id="med-second-amount">
              @endif
              @if ($errors->has('second_amount'))
                <span class="help-block">
                  {{ $errors->first('second_amount') }}
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label" for="second_unit">Unit:</label>
            <div class="col-md-3">
              <input class="form-control" type="text" name="second_unit" value="{{ $medication->second_unit or old('second_unit') }}" id="med-second-unit">
              @if ($errors->has('second_unit'))
                <span class="help-block">
                  {{ $errors->first('second_unit') }}
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
