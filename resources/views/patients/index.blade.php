@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-30 col-md-offset-0s">

            @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message') }}</div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Patients</div>

                <div class="panel-body">
                    This is the patient view page.
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>MRN</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>DOB</th>
                            <th>Sex</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Diagnosis</th>
                            <th>Allergies</th>
                            <th>Physician</th>
                            <th>Code Status</th>
                            <th>Actions</th>
                        </tr>
                    @foreach($patients as $patient)
                    <tr>
                        <td>{{$patient-> id}}</td>
                        <td>{{$patient-> MRN}}</td>
                        <td>{{$patient-> fname}}</td>
                        <td>{{$patient-> lname}}</td>
                        <td>{{$patient-> DOB}}</td>
                        <td>{{$patient-> sex}}</td>
                        <td>{{$patient-> height}}</td>
                        <td>{{$patient-> weight}}</td>
                        <td>{{$patient-> diagnosis}}</td>
                        <td>{{$patient-> allergies}}</td>
                        <td>{{$patient-> physician}}</td>
                        <td>{{$patient-> code_status}}</td>
                        <td>
                            <div style="display:inline-block";>
                            {!! Form::open(array('route'=>['patients.destroy',$patient->id], 'method'=>'DELETE')) !!}
                                {!! link_to_route ('patients.edit', 'Edit', [$patient->id], ['class'=>'btn btn-primary']) !!}

                                {!! Form::button ('Delete',['type'=>'submit','class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
            <form action = "/patients/create">
                <input type="submit" value="Add New Patient" class="btn btn-primary" />
            </form>
        </div>
    </div>
</div>
@endsection
