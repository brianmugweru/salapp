@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($likes as $like)
            <div class="col-sm-3">
                <a href="/salon/{{ $like->salon->id }}/book">
                    <img src="{{ Storage::url($like->salon->image) }}" width="100%" height="200">
                    <p style="text-align:left;">{{ $like->salon->name }}</br> {{ $like->salon->opening_time }}-{{ $like->salon->closing_time }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
