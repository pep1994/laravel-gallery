@extends('layouts.main_layout')

@section('content')
<div class="row">
    <div class="card-deck">
        @foreach ($albums as $album)
            <div class="col-md-3">
                <div class="card">
                    <a href="{{ route('gallery_album_images', $album->id) }}"><img class="card-img-top" src="{{ asset($album->album_thumb) }}" alt="{{ $album->album_name }}"></a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('gallery_album_images', $album->id) }}">
                                {{ $album->album_name }}
                            </a>
                        </h5>
                        <p class="card-text">{{ $album->description }}</p>
                        <p class="card-text"><small class="text-muted">{{ $album->created_at->diffForHumans() }}</small></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection