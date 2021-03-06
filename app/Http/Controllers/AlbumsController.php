<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AlbumRequest;
use App\Http\Requests\AlbumUpdateRequest;
use Auth;
use App\Album;
use App\User;
use App\Photo;
use Str;
use Storage;

class AlbumsController extends Controller
{

    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function index() {
        $albums = Album::orderBy('album_name', 'asc')->where('user_id', Auth::user()->id)->paginate(1);
        
        return view('pages.albums', [
            'albums' => $albums
        ]);
    }

    public function delete($id) {
        $album = Album::findOrFail($id);
        $thumbnail = $album->album_thumb;
        $res = $album->delete();
        if ($res) {
            if ($thumbnail && Storage::disk('public')->exists($thumbnail)) {
                Storage::disk('public')->delete($thumbnail);
            }
        }
        return $res;
    }

    public function show($id) {
        return Album::findOrFail($id);
    }

    public function edit($id) {
        $album = Album::findOrFail($id);
        $this->authorize($album);
        // if($album->user->id !== Auth::user()->id){
        //     abort(401, 'Unauthorized');
        // }
        return view('pages.edit')->with('album', $album);

    }

    public function update(AlbumUpdateRequest $req, $id) {
        $data = $req->only(['name', 'description']);
        $album = Album::findOrFail($id);
        $album_update = Album::where('id', $id)->update([
            'album_name' => $data['name'],
            'description' => $data['description']
        ]);
        if ($this->processFile($req, $id, $album)) {
           $album->save();
        }
        
        $msg = $album_update == 1 ? 'Album ' . Album::find($id)->album_name . " aggiornato" : 'Album ' . Album::find($id)->album_name . " non aggiornato";
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }

    public function create() {
        $album = new Album();
        return view('pages.create-album', compact('album'));
    }

    public function store(AlbumRequest $req) {
        $album = new Album();
        $album->album_name = $req->input('name');
        $album->description = $req->input('description');
        $album->album_thumb = "";
        $user = $req->user();
        $album-> user() -> associate($user);
        $res = $album->save();
        if ($res) {   
            if($this->processFile($req, $album->id, $album)){
                $album->save();
            }
        }

        $msg = "Album " . $album->album_name . " inserito";
        session()->flash('msg', $msg);
        return redirect()->route('albums');
    }

    public function processFile(Request $req, $id, $album){
        if (!$req->hasFile('album_thumb')) {
            return false;
        }

        $file = $req->file('album_thumb');
        if (!$file->isValid()) {
            return false;
        }
        $file_name = Str::slug($id . "_" .$req->input('name')); 
        $ext = $file->extension();
        $file_path = env('ALBUM_THUMB_DIR') . "/" . $file_name . '.' . $ext;
        $file->storeAs(env('ALBUM_THUMB_DIR'), $file_name . "." . $ext, 'public');
        $album -> album_thumb = $file_path;
        return true;
    }

    public function getImages($id) {
        $album = Album::findOrFail($id);
        $images = $album->photos()->paginate(env('IMG_FOR_PAGE'));
        return view('pages.album_images', compact('album', 'images'));
    }

    
}
