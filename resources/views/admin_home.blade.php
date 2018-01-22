@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Administrative Page</h1></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4><strong>Patients:</strong></h4>
                  <div>
                  <a href='/patients/index' class="btn btn-info" role="button">View All Patients</a>
                  <a href='/patients/create' class="btn btn-info" role="button">Create New Patient</a><br>
                </div>
                <h4><strong> Orders: </strong></h4>
                  <a href='/orders/index' class="btn btn-info" role="button">View All Orders</a>
                  <a href='/orders/create' class="btn btn-info" role="button">Create New Order</a><br>
                  <h4><strong> Labs:</strong></h4>
                   <a href='/labs/index' class="btn btn-info" role="button">View All Labs</a>
                   <a href='labs/create' class="btn btn-info" role="button">Create New Lab</a>
                   <h4><strong>Assessments:<strong></h4>
                    <a href='#' class="btn btn-info" role="button">View all assessments</a>
                    <a href='#' class="btn btn-info" role="button">Create New Assessment</a>

                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
