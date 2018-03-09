@extends("layouts.app")
@section("title", "Vitae NET - Signatures")
@section("content")
<form method="post" action="{{ route('signatures.delete') }}">
  <div class="col-md-offset-1 col-md-10">
    @if ($signatures->isEmpty())
      <div class="row">
        <h3 class="col-md-offset-2 col-md-8 text-center">No signatures in the database.</h3>
      </div>
    @else
      {{ csrf_field() }}
      <div class="panel panel-default" id="panel">
        <div class="panel-heading">Signatures</div>
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Patient</th>
              <th>Medication</th>
              <th>Time</th>
              <th>Delete</th>
            <tr>
          </thead>
          <tbody>
            @foreach ($signatures as $signature)
              <tr>
                <td>{{ $signature->student_name }}</td>
                <td>{{ $signature->patient->first_name }} {{ $signature->patient->last_name }}</td>
                <td>{{ $signature->medication->toString() }}</td>
                <td>{{ $signature->time }}</td>
                <td><input type="checkbox" name="ids[{{ $signature->id }}]" value="{{ $signature->id }}"></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="panel-body">
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#signatures-delete-modal">Delete</button>
        </div>
      </div>
    @endif
  </div>
  <div class="modal fade" id="signatures-delete-modal" tabindex=-1 role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Signature(s)</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete these signature(s)?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default col-md-offset-7 col-md-2" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger col-md-2">Yes</button>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
