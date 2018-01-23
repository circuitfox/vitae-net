@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-30 col-md-offset-0s">

            @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message') }}</div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Labs</div>

                <div class="panel-body">
                    This is the lab view page.
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Patient ID</th>
                            <th>Actions</th>
                        </tr>
                    @foreach($labs as $lab)
                    <tr>
                        <td>{{$lab-> id}}</td>
                        <td>{{$lab-> name}}</td>
                        <td>{{$lab-> description}}</td>
                        <td>{{$lab-> patient_id}}</td>
                        <td>
                        <div style="display:inline-block";>
                          <form action="labs/{{$lab-> id}}/edit">
                              <input type="submit" value="Edit">
                          </form>
                          |
                          <a href= "../storage/{{$lab-> file_path}}"  class="btn btn-info" role="button">View Lab</a>
                          |
                          <form method='POST' action='/labs/{{$lab-> id}}' enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="submit" value="Delete">
                          </form>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
            <form action = "/labs/create">
                <input type="submit" value="Add New Lab" class="btn btn-primary" />
            </form>
        </div>
    </div>
</div>
@endsection
