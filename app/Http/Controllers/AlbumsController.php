<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\User;
use Str;

class AlbumsController extends Controller
{
    public function index() {
        $albums = Album::orderBy('album_name', 'asc')->get();
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
        $album = Album::findOrFail($id);
        $album_update = Album::where('id', $id)->update([
            'album_name' => $data['name'],
            'description' => $data['description']
        ]);
        if ($req->hasFile('album_thumb')) {
            $file = $req->file('album_thumb');
            if ($file -> isValid()) {
                $file_name = Str::slug($id . "_" .$req->input('name')); 
                $ext = $file->extension();
                $file_path = $file_name . '.' . $ext;
                $file->storeAs(env('ALBUM_THUMB_DIR'), $file_path, 'public');
                $album -> album_thumb = $file_path;
                $album -> save();
            }
        }
        $msg = $album_update == 1 ? 'Album ' . Album::find($id)->album_name . " aggiornato" : 'Album ' . Album::find($id)->album_name . " non aggiornato";
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }

    public function create() {
        return view('pages.create-album');
    }

    public function store(Request $req) {

        $album = new Album();
        $album->album_name = $req->input('name');
        $album->description = $req->input('description');
        $user = User::inRandomOrder() -> first();
        $album-> user() -> associate($user);
        $album->save();

        $msg = "Album " . $album->album_name . " inserito";
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }
}
