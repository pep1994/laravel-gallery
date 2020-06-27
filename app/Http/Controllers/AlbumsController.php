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
    }

    public function show($id) {
        return Album::findOrFail($id);
    }

    public function edit($id) {
        $album = Album::findOrFail($id);
        return view('pages.edit')->with('album', $album);
    }

    public function update(Request $req, $id) {
        $data = $req->only(['name', 'description']);
        $album_update = Album::where('id', $id)->update([
            'album_name' => $data['name'],
            'description' => $data['description']
        ]);
        $msg = $album_update == 1 ? 'Album ' . Album::find($id)->album_name . " aggiornato" : 'Album ' . Album::find($id)->album_name . " non aggiornato";
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }
}
