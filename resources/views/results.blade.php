@extends('header')

@section('page-content')

    <ul class="list-group mx-auto p-5" style="width: 800px;">
        <li class="list-group-item">Movie Title: {!! $movieData['movieTitle'] !!}</li>
        <li class="list-group-item">Movie Overview: {!! $movieData['movieOverview'] !!}</li>
        <li class="list-group-item">Movie Release Date: {!! $movieData['movieReleaseDate'] !!}</li>
        <li class="list-group-item">Movie Runtime in Minutes: {!! $movieData['movieRuntime'] !!}</li>

        @foreach($movieData['movieCast'] as $cast)
            <li class="list-group-item">Cast Member #{{$loop->iteration}}: {{$cast}}</li>

            @if ($loop->iteration == 10)
                @break
            @endif

        @endforeach
        
    </ul>

@endsection


