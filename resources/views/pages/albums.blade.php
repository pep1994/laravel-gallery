@extends('layouts.main_layout')

@section('content')
    <h2>ALBUMS</h2>
    @if (session()->has('msg'))
        @component('components.alert-info')
        {{ session()->get('msg') }}
        @endcomponent
    @endif
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Album name</th>
                <th>Thumb</th>
                <th>Creator</th>
                <th>Created Date</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album)
                <tr> 
                   <td>({{ $album -> id }}) {{ $album -> album_name  }} ({{ $album->photos->count() }}) pictures</td>
                   <td>
                       @if ($album -> album_thumb)
                            <img width=120 
                                @if (stristr($album -> album_thumb, 'http') !== false)
                                    src="{{ asset($album->album_thumb) }}"
                                @else
                                    src="{{asset('storage/' . $album->album_thumb) }}"
                                @endif
                             alt="{{ $album->album_name }}" title="{{ $album->album_name }}"/>       
                       @endif
                   </td>
                   <td>{{ $album ->user->name }}</td>
                   <td>{{ $album->created_at }}</td>
                   <td>
                       <a title="Add picture" href="{{route('create_photo')}}?album_id={{ $album->id }}" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </a> 
                       @if ($album->photos->count() > 0) 
                            <a title="View images" href="{{route('images_album', $album->id)}}" class="btn btn-primary"><i class="fas fa-search"></i></a> 
                       @endif
                       <a title="Update album" href="{{route('edit_album', $album->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a> 
                       <a title="Delete album" href="{{route('delete_album', $album->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a> 
                   </td>
                </tr>
            @endforeach  
            <tr>
                <td colspan="6" class="text-center">
                    <div class="row justify-content-center">
                        <div class="col-md-8 push-4 text-center d-flex justify-content-center">
                            {{ $albums->links() }}
                        </div>
                    </div>
                </td>
            </tr>  
        </tbody> 
    </table>
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
