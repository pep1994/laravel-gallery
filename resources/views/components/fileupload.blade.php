<div class="form-group">
    <label for="name">Thumbnail</label>
    <input type="file" name="album_thumb" id="album_thumb" class="form-control" placeholder="Album name" value="{{ $album->album_name }}">
  </div>

@if ($album->album_thumb)      
    <div class="form-group">
        <img width="300" 
        @if (stristr($album -> album_thumb, 'http') !== false)
            src="{{ asset($album->album_thumb) }}"
        @else
            src="{{ asset('storage/' . $album->album_thumb) }}"
        @endif
            alt="{{ $album->album_name }}" title="{{ $album->album_name }}"/>   
    </div>
@endif