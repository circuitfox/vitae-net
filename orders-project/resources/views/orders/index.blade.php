@extends('layouts.app')

@section('content')
<style>
table {border: solid 1px lightgrey;}
td {border-right: solid 1px lightgrey;
   border-left: solid 1px lightgrey;}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-30 col-md-offset-0s">

            @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message') }}</div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Orders</div>

                <div class="panel-body">
                    This is the order view page.
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Patient ID</th>
                            <th>Actions</th>
                        </tr>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order-> id}}</td>
                        <td>{{$order-> name}}</td>
                        <td>{{$order-> description}}</td>
                        <td>{{$order-> patient_id}}</td>
                        <td>
                            <div style="display:inline-block";>
                            {!! Form::open(array('route'=>['orders.destroy',$order->id], 'method'=>'DELETE')) !!}
                                {!! link_to_route ('orders.edit', 'Edit', [$order->id], ['class'=>'btn btn-primary']) !!}
                            |
                            <a href= "../storage/{{$order-> path}}"  class="btn btn-info" role="button">View Order</a>
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
            <form action = "/orders/create">
                <input type="submit" value="Add New Order" class="btn btn-primary" />
            </form>
        </div>
    </div>
</div>
@endsection
