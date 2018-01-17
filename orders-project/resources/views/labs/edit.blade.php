@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-15 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{$lab-> name}}</div>

                <div class="panel-body">
                  {!! Form::model($lab,array('route'=>['labs.update', $lab->id], 'method'=>'PATCH')) !!}
                  <div class="form-group">
                    {!! Form::label('name', 'Edit Name') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('description', 'Edit Description') !!}
                    {!! Form::text('description', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group">
                    {!! Form::label('patient_id', 'Edit Patient ID') !!}
                    {!! Form::number('patient_id', null, ['class'=>'form-control']) !!}
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