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
                            {!! Form::open(array('route'=>['labs.destroy',$lab->id], 'method'=>'DELETE')) !!}
                                {!! link_to_route ('labs.edit', 'Edit', [$lab->id], ['class'=>'btn btn-primary']) !!}
                            |
                              <a href= "../storage/{{$lab-> path}}"  class="btn btn-info" role="button">View Lab Results</a>
                              |
                                {!! Form::button ('Delete',['type'=>'submit','class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
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
