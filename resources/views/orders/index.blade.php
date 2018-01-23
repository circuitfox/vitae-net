@extends('layouts.app')

@section('content')
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
                              <form action="orders/{{$order-> id}}/edit">
                                  <input type="submit" value="Edit">
                              </form>
                              |
                              <a href= "../storage/{{$order-> file_path}}"  class="btn btn-info" role="button">View Order</a>
                              |
                              <form method='POST' action='/orders/{{$order-> id}}' enctype="multipart/form-data">
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
            <form action = "/orders/create">
                <input type="submit" value="Add New Order" class="btn btn-primary" />
            </form>
        </div>
    </div>
</div>
@endsection
