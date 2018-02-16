<!doctype html>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($salons as $salon)
            <div class="col-sm-3">
                <a href="/salon/{{ $salon->id }}/book">
                    <img src="{{ Storage::url($salon->image) }}" width="100%" height="200">
                    <p style="text-align:left;">{{ $salon->name }}</br> {{ $salon->rank }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
