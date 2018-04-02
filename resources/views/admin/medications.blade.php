@extends("layouts.app")
@section("title", "Vitae NET - Medication")
@section("content")
<div class="container col-md-8 col-md-offset-2">
  <? $medications = App\Medication::all(); ?>
  @if ($medications->isEmpty())
    <div class="panel panel-default">
      @if (Auth::user()->isPrivileged())
        <div class="panel-header">
          <div class="row">
            <h3 class="col-md-offset-2 col-md-8 text-center">No medications in the database. Add some?</h3>
          </div>
        </div>
        <div class="panel-body">
          <a href="{{ route('medications.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Medications</a>
        </div>
      @else
        <div class="panel-header">
          <div class="row">
            <h3 class="col-md-offset-2 col-md-8 text-center">No medications in the database.</h3>
          </div>
        </div>
      @endif
    </div>
  @else
    <div class="panel-group" id="medications" role="tablist">
      @foreach ($medications as $medication)
        <div class="panel panel-default">
          <div class="panel-heading" role="tab">
            <div class="row">
              <div class="panel-title">
                <a class="accordion collapsed col-md-8" role="button" data-toggle="collapse" data-parent="#medications" data-target="#medication{{ $medication->medication_id }}">
                  @include("partials.medication.header", ["medication" => $medication])
                </a>
              </div>
              <div class="btn-toolbar col-md-4">
                @if (Auth::user()->isPrivileged())
                  <a href="/medications/{{ $medication->medication_id }}/edit" class="btn btn-primary h3">Edit</a>
                  <button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#medication-delete-modal" data-id="{{ $medication->medication_id }}">Delete</button>
                @endif
              </div>
            </div>
          </div>
          <div id="medication{{ $medication->medication_id }}" class="panel-collapse collapse" role="tabpanel">
            <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                @include("partials.medication.body", ["medciation" => $medication])
              </div>
              </div>
              <div class="row">
                <div class="col-sm-8">
                  <h5><b><u>Bar Code</u></b></h5>
                  <?php echo $medication->generateBarcode(); ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4" style="margin-top:10px;">
                    <?php echo $medication->generateDownloadButton(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
  @include("partials.medication.delete-modal")
</div>
@endsection
