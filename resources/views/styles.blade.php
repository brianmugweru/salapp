@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($styles as $style)
            <div class="col-sm-3">
                <a href="salon/{{ $style->salon->id }}/book">
                    <img src="{{ Storage::url($style->image) }}" width="100%" height="200">
                    <p style="text-align:left;">{{ $style->name }},&nbsp{{ $style->time_taken}}</br> {{ $style->salon->name }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
