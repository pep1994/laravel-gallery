@extends('layouts.main_layout')
@section('content')
    @if (session()->has('msg'))
        @component('components.alert-info')
        {{ session()->get('msg') }}
        @endcomponent
    @endif
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <table class="table">
        <tr>
            <th>
                CREATED DATE
            </th>
            <th>
                TITLE
            </th>
            <th>
                ALBUM
            </th>
            <th>
                THUMBNAIL
            </th>
        </tr>
        @forelse ($images as $image)
            <tr>
                <td>{{ $image->created_at }}</td>
                <td>{{ $image->name }}</td>
                <td>{{ $album->album_name }}</td>
                <td>
                    <img width="120" 
                    @if (stristr($image->img_path, 'http') !== false)
                        src="{{ asset($image->img_path) }}"
                    @else
                        src="{{ asset('storage/' . $image->img_path) }}" 
                    @endif
                    alt="{{ $image->name }}">
                </td>
                <td>
                    <a href="{{ route('edit_photo', $image->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{ route('delete_photo', $image->id) }}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="5">
                        No images found
                    </td>
                </tr>
        @endforelse
    </table>
@endsection

@section('script')
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script>
        $(document).ready(function () {
            // if ($('div.alert')) {
            //     $('div.alert').fadeOut(4000);
            // }
            $('table').on('click', 'a.btn-danger', function(e){
                e.preventDefault();
                var urlAlbum = $(this).attr('href');
                console.log(urlAlbum)
                var parent = $(this).parents('tr');
                
                $.ajax({
                    type: "DELETE",
                    url: urlAlbum,
                    data: {
                        '_token': $('#_token').val()
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