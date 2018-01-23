@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-15 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{$patient-> fname}} {{$patient-> lname}}</div>

                <div class="panel-body">
                  {!! Form::model($patient,array('route'=>['patients.update', $patient->id], 'method'=>'PATCH')) !!}
                  <div class="form-group">
                    {!! Form::label('MRN', 'Edit MRN') !!}
                    {!! Form::text('MRN', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('fname', 'Edit First Name') !!}
                    {!! Form::text('fname', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('lname', 'Edit Last Name') !!}
                    {!! Form::text('lname', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('DOB', 'Edit DOB') !!}
                    {!! Form::date('DOB', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('sex', 'Edit Sex') !!} <br>
                    {!! Form::text('sex', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('height', 'Edit Height') !!}
                    {!! Form::text('height', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('diagnosis', 'Edit Diagnosis') !!}
                    {!! Form::text('diagnosis', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('allergies', 'Edit Allergies') !!}
                    {!! Form::text('allergies', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('physician', 'Edit Physician') !!}
                    {!! Form::text('physician', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('code_status', 'Edit Code Status') !!}
                    {!! Form::text('code_status', null, ['class'=>'form-control']) !!}
                  </div>


                  <div class="form-group">
                    {!! Form::button ('Update',['type'=>'submit','class'=>'btn btn-primary']) !!}
                  </div>
                  {!! Form::close() !!}
     </div>
    </div>
   </div>
  </div>
</div>
@endsection
