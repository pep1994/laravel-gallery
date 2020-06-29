@extends('layouts.main_layout')
@section('content')
    <h2>New Album</h2>
    @include('components.errors_validate')
    <form action="{{ route('store_album') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" required name="name" id="name" class="form-control" placeholder="Album name" value="{{ old('name') }}">
        </div>
        @include('components.fileupload')
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" required id="description" class="form-control" placeholder="Description"> {{ old('description') }}
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection