@extends('layouts.app')

@section('content')

<style>
table {border: solid 1px lightgrey;}
td {border-right: solid 1px lightgrey;
   border-left: solid 1px lightgrey;}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Patient List:</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                 <table class="table">
                        <tr>
                            <th></th>
                            <th>MRN</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th> DOB </th>
                            <th>Sex</th>
                            <th>Code Status</th>
                        </tr>
                    @foreach($patients as $patient)
                    <tr>

                        <td>
                            <div style="display:inline-block";>
                            {!! Form::open(array('route'=>['patients.destroy',$patient->id], 'method'=>'DELETE')) !!}
                                {!! link_to_route ('patients.show', 'Select', [$patient->id], ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                            </div>
                        </td>
                        <td>{{$patient-> MRN}}</td>
                        <td>{{$patient-> fname}}</td>
                        <td>{{$patient-> lname}}</td>
                        <td>{{$patient->DOB}}</td>
                        <td>{{$patient-> sex}}</td>
                        <td>{{$patient-> code_status}}</td>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
