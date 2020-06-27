@extends('layouts.main_layout')

@section('content')
    <h2>ALBUMS</h2>
    @if (session()->has('msg'))
        @component('components.alert-info')
        {{ session()->get('msg') }}
        @endcomponent
    @endif
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between"> 
               {{  $album -> album_name  }}
               <div>
                   @if ($album -> album_thumb)
                        <img width="300" src="{{ $album->album_thumb }}" alt="{{ $album->album_name }}" title="{{ $album->album_name }}"/>       
                   @endif
                   <a href="{{route('edit_album', $album->id)}}" class="btn btn-primary">Edit</a> 
                   <a href="{{route('delete_album', $album->id)}}" class="btn btn-danger">Delete</a> 
               </div>
            </li>
        @endforeach        
    </ul>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            if ($('div.alert')) {
                $('div.alert').fadeOut(4000);
            }
            $('ul').on('click', 'li a.btn-danger', function(e){
                e.preventDefault();
                var urlAlbum = $(this).attr('href');
                var parent = $(this).parents('li');
                
                $.ajax({
                    type: "DELETE",
                    url: urlAlbum,
                    headers: {
                        'X-CSRF-Token': $('#_token').val()
                    },
                    success: function (data) {
                        if (data == 1)  {
                            parent.remove();
                        }
                    }
                });
            })
        });
</script>
@endsection
