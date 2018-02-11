@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <span style="float:right"><a href="/salon">View Salons</a></span></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-8 col-md-offset-2">
                        <form action="{{ url('salon') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="name" placeholder="Enter Salon Name"><br>
                            <input type="text" class="form-control" name="longitude" placeholder="Enter Longitude"><br>
                            <input type="text" class="form-control" name="latitude" placeholder="Enter Latitude"><br>
                            <input type="text" class="form-control" name="opening_time" placeholder="Enter opening time"><br>
                            <input type="text" class="form-control" name="closing_time" placeholder="Enter closing time"><br>
                            <input type="file" class="form-control" name="image"><br>
                            <input type="submit" name="submit" value="Add Salon" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
