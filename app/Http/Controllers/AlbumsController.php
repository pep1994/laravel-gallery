<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    public function index() {
        $albums = Album::all();
        return view('pages.albums', [
            'albums' => $albums
        ]);
    }

    public function delete($id) {
        return Album::findOrFail($id) -> delete();
        // return redirect() -> back();
    }

    public function show($id) {
        return Album::findOrFail($id);
        // return redirect() -> back();
    }
}
