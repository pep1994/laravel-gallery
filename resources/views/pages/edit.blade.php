@extends('layouts.main_layout')
@section('content')
    <h2>Edit Album</h2>
    <form action="{{ route('update_album', $album->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Album name" value="{{ $album->album_name }}">
        </div>
        
        @include('components.fileupload')
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Description"> {{ $album->description }}
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection