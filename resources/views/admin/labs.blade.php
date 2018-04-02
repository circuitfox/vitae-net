@extends("layouts.app")
@section("title", "Vitae NET - Labs")
@section("content")
<div class="container col-md-8 col-md-offset-2">
  <? $labs = App\Lab::all(); ?>
  @if ($labs->isEmpty())
    <div class="panel panel-default">
      @if (Auth::user()->isAdmin() || Auth::user()->isInstructor())
        <div class="panel-header">
          <div class="row">
            <h3 class="col-md-offset-2 col-md-8 text-center">No labs in the database. Add some?</h3>
          </div>
        </div>
        <div class="panel-body">
          <a href="{{ route('labs.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Labs</a>
        </div>
      @else
        <div class="panel-header">
          <div class="row">
            <h3 class="col-md-offset-2 col-md-8 text-center">No labs in the database.</h3>
          </div>
        </div>
      @endif
    </div>
  @else
    <div class="panel-group" id="labs" role="tablist">
      @foreach ($labs as $lab)
        <div class="panel panel-default">
          <div class="panel-heading" role="tab">
            <div class="row">
              <a class="accordion collapsed col-md-8" role="button" data-toggle="collapse" data-parent="#labs" data-target="#lab{{ $lab->id }}">
                @include("partials.lab.header", ["lab" => $lab])
              </a>
              <div class="btn-toolbar col-md-4">
                <a href="/labs/{{ $lab->id }}" class="btn btn-primary h3">Details</a>
                @if (Auth::user()->isAdmin() || Auth::user()->isInstructor())
                  <a href="/labs/{{ $lab->id }}/edit" class="btn btn-primary h3">Edit</a>
                  <button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#lab-delete-modal" data-id="{{ $lab->id }}">Delete</button>
                @endif
              </div>
            </div>
          </div>
          <div id="lab{{ $lab->id }}" class="panel-collapse collapse" role="tabpanel">
            <div class="panel-body">
              @include("partials.lab.body", ["lab" => $lab])
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
  @include("partials.lab.delete-modal")
</div>
@endsection
