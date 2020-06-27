@extends('layouts.main_layout')

@section('content')
    <h2>ALBUMS</h2>
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between"> 
               {{  $album -> album_name  }}
                <a href="{{route('delete_album', $album->id)}}" class="btn btn-danger">Delete</a> 
            </li>
        @endforeach        
    </ul>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('ul').on('click', 'li a', function(e){
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
