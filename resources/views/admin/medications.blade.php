@extends("layouts.app")
@section("title", "Vitae NET - Medication")
@section("content")
<div class="container col-panel">
  @if ($medications->isEmpty())
    <div class="panel panel-default">
      <div class="panel-header">
        <div class="row">
          <h3 class="text-center">No medications in the database.</h3>
        </div>
      </div>
      <div class="panel-body">
        @if (Auth::user()->isPrivileged())
          <a href="{{ route('medications.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Medications</a>
        @endif
      </div>
    </div>
  @else
    <div class="list-group" id="medications" role="tablist">
      <div class="list-group-item">
        <div class="list-group-item-heading">
          @if (Auth::user()->isPrivileged())
            <div class="pull-right">
              <a class="btn btn-success" href="{{ route('medications.create') }}">Add Medication</a>
            </div>
          @endif
          <h2>Medications</h2>
        </div>
      </div>
      @foreach ($medications as $medication)
        <div class="list-group-item clearfix">
          <div class="list-group-item-heading" role="tab">
            @if (Auth::user()->isPrivileged())
              <div class="btn-toolbar pull-right">
                <a href="/medications/{{ $medication->medication_id }}/edit" class="btn btn-primary">Edit</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#medication-delete-modal" data-id="{{ $medication->medication_id }}">Delete</button>
              </div>
            @endif
            <a class="accordion collapsed item-title" role="button" data-toggle="collapse" data-parent="#medications" data-target="#medication{{ $medication->medication_id }}">
                @include("partials.medication.header", ["medication" => $medication])
            </a>
          </div>
          <div id="medication{{ $medication->medication_id }}" class="collapse" role="tabpanel">
            <div class="list-group-item-text">
              <div class="row">
                <div class="col-sm-12">
                  @include("partials.medication.body", ["medciation" => $medication])
                </div>
              </div>
              @if (Auth::user()->isPrivileged())
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
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
  @if (Auth::user()->isPrivileged())
    @include("partials.medication.delete-modal")
  @endif
</div>
@endsection
