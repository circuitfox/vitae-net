@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Patient Info</div>

                <div class="panel-body">
                  <div class="form-group">

                    <table class= "table">
                        <tr><td>
                    <strong>MRN:</strong> {{$patient-> MRN}} <br>
                    <strong>Name:</strong>
                    {{$patient-> fname}}
                    {{$patient-> lname}} <br>
                    <strong>Date Of Birth:</strong>
                    {{$patient-> DOB}}<br>
                    <strong>Sex:</strong>
                    {{$patient-> sex}}<br>
                    <strong>Height:</strong>
                    {{$patient-> height}}<br>
                    <strong>Weight:</strong>
                    {{$patient-> weight}}<br>
                    </td><td>
                    <strong>Diagnosis:</strong><br>
                    {{$patient-> diagnosis}}<br>
                    <strong>Allergies:</strong><br>
                    {{$patient-> allergies}}<br>
                    <strong>Physician:</strong>
                    {{$patient-> physician}}<br>
                    <strong>Code Status:</strong>
                    {{$patient-> code_status}}<br>
                    </td></tr>
                    </table>
     </div>
    </div>
   </div>
   <div class="col-xs-6 col-md-6">
       <div class="panel panel-info height">
           <div class="panel-heading">Lab Results</div>
           <div class="panel-body">
             <table class= "table">
               @foreach($labs as $lab)
               <tr><td>
               <a href= "../storage/{{$lab-> path}}" style="color:black">{{$lab-> name}}&nbsp;&nbsp;-&nbsp;&nbsp;{{$lab-> description}}</a>
             </td></tr>
               @endforeach
             </table>
           </div>
       </div>
  </div>
  <div class="col-xs-6 col-md-6">
      <div class="panel panel-info height">
          <div class="panel-heading">Provider's Orders</div>
          <div class="panel-body">
            <table class= "table">
              @foreach($orders as $order)
              <tr><td>
                  <a href= "../storage/{{$order-> path}}" style="color:black">{{$order-> name}}&nbsp;&nbsp;-&nbsp;&nbsp;{{$order-> description}}</a>
              </td></tr>
              @endforeach
            </table>
          </div>
      </div>
 </div>
 <div class="col-xs-6 col-md-6">
     <div class="panel panel-info height">
         <div class="panel-heading">Pending Orders</div>
         <div class="panel-body">
           <table class= "table">
           @foreach($pendings as $pending)
           <tr><td>
           <a href= "../storage/{{$pending-> path}}" style="color:black">{{$pending-> name}}&nbsp;&nbsp;-&nbsp;&nbsp;{{$pending-> description}}</a>
           </td><td>
           {{ Form::open(array('route' => 'complete')) }}
           {{ Form::hidden('order_id', $pending->id, ['id' => 'order_id']) }}
           {{ Form::button ('Complete',['type'=>'submit','class'=>'btn btn-primary']) }}
           {{ Form::close() }}
           </td></tr>
           @endforeach
         </table>
         </div>
     </div>
</div>
<div class="col-xs-6 col-md-6">
    <div class="panel panel-info height">
        <div class="panel-heading">Assessments</div>
        <div class="panel-body">
            <strong>links to assessments</strong><br>
        </div>
    </div>
</div>
  </div>
 </div>
 <style>
 .height {
     min-height: 200px;
 }

 .icon {
     font-size: 47px;
     color: #5CB85C;
 }

 .iconbig {
     font-size: 77px;
     color: #5CB85C;
 }

 .table > tbody > tr > .emptyrow {
     border-top: none;
 }

 .table > thead > tr > .emptyrow {
     border-bottom: none;
 }

 .table > tbody > tr > .highrow {
     border-top: 3px solid;
 }
 </style>
@endsection
