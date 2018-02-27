@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <form method="GET" action="/search">
                {{ csrf_field() }}
                <input type="text" name="salon" placeholder="enter salon name"/>
                <input type="submit" class="btn btn-primary" value="search" name="search">
            </form>
            </div>
        </div><br>
        <div class="row">
            @foreach($salons as $salon)
            <div class="col-sm-3">
                <a href="/salon/{{ $salon->id }}">
                    <img src="{{ Storage::url($salon->image) }}" width="100%" height="200">
                    <p style="text-align:left;">{{ $salon->name }}</br> {{ $salon->rank }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
