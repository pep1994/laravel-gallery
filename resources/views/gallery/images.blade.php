@extends('layouts.main_layout')
@section('content')
    <div class="row">
        @foreach ($images as $image)
            <div class="col-md-4 col-sm-6 col-lg-2">
                <a href="{{ asset($image->img_path) }}" data-lightbox="{{ $album->album_name }}">
                    <img   width="250" class="img-fluid img-thumbnail" src="{{ asset($image->img_path) }}" alt="{{ $image->name }}">
                </a>
            </div>
        @endforeach
    </div>
@endsection