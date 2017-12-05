@extends("layouts.app")
@section("title", "Medscanner Administration - Users")
@section("content")
<div class="container col-md-8 col-md-offset-2">
  <? $users = App\User::all(); ?>
  <div class="panel-group" id="users" role="tablist">
    @foreach ($users as $user)
      <div class="panel panel-default">
        <div class="panel-heading" role="tab">
          @if(Auth::check())
            @if (Auth::user()->isAdmin())
              <div class="row">
                <a class="accordion collapsed col-md-8" role="button" data-toggle="collapse" data-parent="#users" data-target="#user{{ $user->id }}">
                  @include("partials/user/header", ["user" => $user])
                </a>
                <div class="btn-toolbar col-md-4">
                  <button type="button" class="btn btn-danger h3" data-toggle="modal" data-target="#user-delete-modal" data-id="{{ $user->id }}">Delete</button>
                </div>
              </div>
            @else
              <a class="accordion collapsed" role="button" data-toggle="collapse"
                    data-parent="#users" data-target="#user{{ $user->id }}">
                  @include("partials/user/header", ["user" => $user])
              </a>
            @endif
          @endif
        </div>
        <div id="user{{ $user->id }}" class="panel-collapse collapse" role="tabpanel">
          <div class="panel-body">
            @include("partials/user/body", ["user" => $user])
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @if(Auth::check())
    @if (Auth::user()->isAdmin())
      @include("partials/user/delete-modal")
    @endif
  @endif
</div>
@endsection
