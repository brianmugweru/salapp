@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <span style="float:right"><a href="/salon/create">add salon</a></span></div>

                <div class="panel-body" style="clear:both;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table style="width:100%">
                        <tr>
                            <th>name</th>
                            <th>location</th>
                            <th>opening_time</th>
                            <th>closing_time</th>
                            <th>image</th>
                            <th>Ranking</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($salons as $salon)
                            <tr>
                                <td>{{ $salon->name }}</td>
                                <td>{{ $salon->longitude }}</td>
                                <td>{{ $salon->opening_time }}</td>
                                <td>{{ $salon->closing_time }}</td>
                                <td><img src="{{ Storage::url( $salon->image ) }}" height="50" width="50" alt="found"/></td>
                                <td>{{ $salon->ranking }}</td>
                                <td>
                                    <a href="{{ URL::to('/salon/'. $salon->id .'/edit') }}">edit</a><br>
                                    <a href="{{ URL::to('/salon/'. $salon->id) }}">view</a><br>
                                    {!! Form::open([ 'method'=>'DELETE','route'=>['salon.destroy', $salon->id]]) !!}
                                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <!--<a href="{{ URL::to('/salon/'. $salon->id) }}">delete</a>-->
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
