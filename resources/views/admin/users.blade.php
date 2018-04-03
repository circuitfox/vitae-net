@extends("layouts.app")
@section("title", "Vitae NET Administration - Users")
@section("content")
<div class="container col-panel">
  <div class="list-group" id="users" role="tablist">
    <div class="list-group-item">
      <div class="list-group-item-heading">
        @if (Auth::user()->isAdmin())
          <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}">Add User</a>
          </div>
        @endif
        <h2>Users</h2>
      </div>
    </div>
    @foreach ($users as $user)
      <div class="list-group-item clearfix">
        <div class="list-group-item-heading" role="tab">
          @if (Auth::user()->isAdmin())
            <div class="btn-toolbar pull-right">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#user-delete-modal" data-id="{{ $user->id }}">Delete</button>
            </div>
          @endif
          <a class="accordion collapsed item-title" role="button" data-toggle="collapse" data-parent="#users" data-target="#user{{ $user->id }}">
            @include("partials/user/header", ["user" => $user])
          </a>
        </div>
        <div id="user{{ $user->id }}" class="collapse" role="tabpanel">
          <div class="list-group-item-text">
            @include("partials/user/body", ["user" => $user])
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@if (Auth::user()->isAdmin())
  @include("partials/user/delete-modal")
@endif
</div>
@endsection
