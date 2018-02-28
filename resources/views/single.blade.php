@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <span style="float:right"><a href="/">View Salons</a></span></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>{{ $salon->name }}</h4>
                                <img src="{{ Storage::url( $salon->image )}}" height="200" width="100%" alt="found"/>
                            </div>
                            <div class="col-sm-6" style="margin-top:50px;">
                                <p>Opening time:<strong>  {{ $salon->opening_time }}</strong></p>
                                <p>Closing time:<strong>  {{ $salon->closing_time }}</strong></p>
                                <p>latitude: <strong> {{ $salon->latitude }}</strong></p>
                                <p>longitude: <strong> {{ $salon->longitude }}</strong></p>
                                @auth
                                        {{ auth()->user()->pivot }}
                                        <p><i class="fa fa-heart"></i>already liked</p>
                                        <p><a href="/salon/{{ $salon->id }}/like">Like Salon</a></p>
                                        <a data-toggle="modal" data-target="#book" href="#" class="btn btn-default btn-small"><i class="fa fa-check-square" style="color:#2a3da5"></i> Book</a>
                                @endauth

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="book" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Book Session</h4>
            </div>
            <div class="modal-body" style="padding-left:25px;padding-right:25px;">
                <form class="form-horizontal" action="/salon/{{$salon->id}}/book" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select class="form-control" name="style" required>
                            <option value="">Service/Style</option>
                            @foreach ($salon->styles as $style)
                                <option value="{{ $style->name }}">{{ $style->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start">Start Time (24hrs System)</label>
                        <input type="text" name="time" class="form-control" id="starttime" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Book</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
