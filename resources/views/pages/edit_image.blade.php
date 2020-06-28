@extends('layouts.main_layout')

    @section('content')
        <h2>Edit Photo</h2>
        <form action="{{ route('update_photo', $photo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Album name" value="{{ $photo->name }}">
            </div>
            <input type="hidden" name="album_id" value="{{ $photo->album_id }}"/>
            @include('components.fileupload_image')
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Description"> {{ $photo->description }}
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    @endsection