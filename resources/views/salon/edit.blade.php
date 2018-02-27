@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <span style="float:right"><a href="/dashboard/salon">View Salons</a></span></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-8 col-md-offset-2">
                        <form action="{{ url('/dashboard/salon/'.$salon->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="text" class="form-control" name="name" placeholder="Name: {{ $salon->name }}"><br>

                            <input type="text" class="form-control" name="longitude" placeholder="Longitude: {{ $salon->longitude }}"><br>
                            <input type="text" class="form-control" name="latitude" placeholder="Latitude: {{ $salon->latitude }}"><br>
                            <input type="text" class="form-control" name="opening_time" placeholder="Opening Time: {{ $salon->opening_time }}"><br>
                            <input type="text" class="form-control" name="closing_time" placeholder="Closing Time: {{ $salon->closing_time }}"><br>
                            <input type="file" class="form-control" name="image"><br>

                            <input type="submit" name="submit" value="Update Salon" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

