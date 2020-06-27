@extends('layouts.main_layout')
@section('content')
    <h2>Create Album</h2>
    <form action="{{ route('store_album') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Album name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Description"> {{ old('description') }}
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection