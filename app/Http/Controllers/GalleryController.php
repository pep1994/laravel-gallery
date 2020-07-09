<?php

namespace App\Http\Controllers;
use App\Album;
use App\Photo;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index() {

        return view('gallery.albums')->with('albums', Album::latest()->get());
    }

    public function showAlbumImages($id) {

        return view('gallery.images', 
        [
            'images' => Photo::whereAlbumId($id)->latest()->get(),
            'album' => Album::find($id)
        ]);
    }
}
