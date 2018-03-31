@extends("layouts.app")
@section("title", "Vitae NET - Labs")
@section("content")
<div class="container col-panel">
  @if ($labs->isEmpty())
    <div class="panel panel-default">
      <div class="panel-header">
        <div class="row">
          <h3 class="text-center">No labs in the database.</h3>
        </div>
      </div>
      <div class="panel-body">
        @if (Auth::user()->isAdmin())
          <a href="{{ route('labs.create') }}" class="col-md-offset-5 col-md-2 btn btn-default h3">Add Labs</a>
        @endif
      </div>
    </div>
  @else
    <div class="list-group" id="labs" role="tablist">
      <div class="list-group-item">
        <div class="list-group-item-heading">
          @if (Auth::user()->isAdmin())
            <div class="pull-right">
              <a class="btn btn-success" href="{{ route('labs.create') }}">Add Lab</a>
            </div>
          @endif
          <h2>Labs</h2>
        </div>
      </div>
      @foreach ($labs as $lab)
        <div class="list-group-item clearfix">
          <div class="list-group-item-heading" role="tab">
            <div class="btn-toolbar pull-right">
              <a href="/labs/{{ $lab->id }}" class="btn btn-default">Details</a>
              @if (Auth::user()->isAdmin())
                <a href="/labs/{{ $lab->id }}/edit" class="btn btn-primary">Edit</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#lab-delete-modal" data-id="{{ $lab->id }}">Delete</button>
              @endif
            </div>
            <a class="accordion collapsed item-title" role="button" data-toggle="collapse" data-parent="#labs" data-target="#lab{{ $lab->id }}">
              @include("partials.lab.header", ["lab" => $lab])
            </a>
          </div>
          <div id="lab{{ $lab->id }}" class="collapse" role="tabpanel">
            <div class="list-group-item-text">
              @include("partials.lab.body", ["lab" => $lab])
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
  @if (Auth::user()->isAdmin())
    @include("partials.lab.delete-modal")
  @endif
</div>
@endsection
