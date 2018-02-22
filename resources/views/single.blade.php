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
                            <div class="col-sm-3">
                                <h4>{{ $salon->name }}</h4>
                                <img src="{{ Storage::url( $salon->image )}}" height="200" width="250" alt="found"/>
                            </div>
                            <div class="col-sm-6" style="margin-top:50px;">
                                <p>Opening time:<strong>  {{ $salon->opening_time }}</strong></p>
                                <p>Closing time:<strong>  {{ $salon->closing_time }}</strong></p>
                                <p>latitude: <strong> {{ $salon->latitude }}</strong></p>
                                <p>longitude: <strong> {{ $salon->longitude }}</strong></p>
                                @auth
                                    @if ($salon->likes[0]->salon_id == $salon->id and $salon->likes[0]->user_id == auth()->user()->id)
                                        <p><i class="fa fa-heart"></i>already liked</p>
                                    @else
                                        <p><a href="/like/{{ $salon->id }}/{{ auth()->user()->id }}">Like Salon</a></p>
                                    @endif
                                    <a href="/salon/book/{{$salon->id}}"> book session </a>
                                @endauth

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
