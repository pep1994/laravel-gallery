@extends('layouts.main_layout')

    @section('content')
        @if ($photo->id)
            <h2>Edit Photo</h2>
        @else  
             <h2>New Photo</h2>
        @endif
        @include('components.errors_validate')
        @if ($photo->id) 
            <form action="{{ route('update_photo', $photo->id) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
        @else
            <form action="{{ route('store_photo') }}" method="POST" enctype="multipart/form-data">
                
        @endif
            <div class="form-group">
                <label for="album_id">Album</label>
                <select name="album_id" required id="album_id" class="form-control">
                    <option value="">Select</option>
                    @foreach ($albums as $item)
                        <option value="{{ $item->id }}"
                            @if ($item->id === $album->id)
                                selected
                            @endif
                            >{{ $item->album_name }}</option>
                    @endforeach
                </select>
            </div>
            @csrf
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" required id="name" class="form-control" placeholder="Photo name" value="{{ $photo->name ? $photo->name : old('name')}}">
            </div>
            @include('components.fileupload_image')
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" required id="description" class="form-control" placeholder="Description"> {{ $photo->description ? $photo->description : old('description') }}</textarea>
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                @if ($photo->id)
                    Update
                @else
                    Create
                @endif       
            </button>
        </form>
    @endsection