<div class="form-group">
    <label for="name">Thumbnail</label>
    <input type="file"  name="img_path" id="img_path" class="form-control" placeholder="Photo name" value="{{ $photo->name }}">
  </div>

@if ($photo->img_path)      
    <div class="form-group">
        <img width="300" 
        @if (stristr($photo -> img_path, 'http') !== false)
            src="{{ asset($photo->img_path) }}"
        @else
            src="{{ asset('storage/' . $photo->img_path) }}"
        @endif
            alt="{{ $photo->name }}" title="{{ $photo->name }}"/>   
    </div>
@endif