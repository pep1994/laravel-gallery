@extends('layouts.main_layout')

@section('content')
    <h2>ALBUMS</h2>
    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between"> 
               {{  $album -> album_name  }}
                <a href="{{route('delete_album', $album->id)}}" class="btn btn-danger">Delete</a> 
            </li>
        @endforeach        
    </ul>

@endsection
