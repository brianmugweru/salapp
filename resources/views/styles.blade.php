@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($styles as $style)
            <div class="col-sm-3">
                    <img src="{{ Storage::url($style->image) }}" width="100%" height="200">
                    <p style="text-align:left;">{{ $style->name }},&nbsp{{ $style->time_taken}}</br> {{ $style->salon->name }}</p>
            </div>
            @endforeach
        </div>
    </div>
@endsection
