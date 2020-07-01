<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Photo;
use App\Album;
use Auth;
use Str;
use Storage;

class PhotosController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    protected $rules = [
        'album_id' => 'required|integer',
        'name' => 'required|unique:photos,name',
        'description' => 'required',
        'img_path' => 'required|image'
    ];

    protected $error_msg = [
        'album_id.required' => 'Il campo Album deve essere obbligatorio',
        'name.required' => 'Il campo Nome deve essere obbligatorio',
        'description.required' => 'Il campo Descrizione deve essere obbligatorio',
        'img_path.required' => 'Il campo Immagine deve essere obbligatorio'
    ];

    public function index() {

    }

    public function show() {

    }

    public function delete($id) {

        $photo = Photo::findOrFail($id);
        $res = $photo->delete();

        if ($res) {
            $this->deleteFile($id, $photo);
        }
        return $res;
    }

   
    public function edit($id) {
        $photo = Photo::findOrFail($id);
        $album = $photo -> album;
        $albums = $this->getAlbums();
        return view('pages.edit_image', compact('albums', 'photo', 'album'));
    }

    public function update(Request $req, $id) {
        $this->validate($req, $this->rules, $this->error_msg);
        $data = $req->only(['name', 'description', 'album_id']);
        $photo = Photo::findOrFail($id);
        $photo_update = Photo::where('id', $id)->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'album_id' => $data['album_id']
        ]);

        if ($this->processFile($req, $id, $photo)) {
           $photo->save(); 
        } 
        if ($photo_update) {
            $msg ='Image ' . $photo->name . ' aggiornata'; 
        } else {
            $msg ='Image ' . $photo->name . ' non aggiornata'; 
        }
        session()->flash('msg', $msg);
        return redirect()->route('images_album', $data['album_id']);
    }

    public function create(Request $req) {
        $id = $req->has('album_id') ? $req->input('album_id') : null;
        $album = Album::firstOrNew(['id' => $id]);
        $photo = new Photo();
        $albums = $this->getAlbums();
        return view('pages.edit_image', compact('photo', 'album', 'albums'));
    }

    public function store(Request $req) {
        $this->validate($req, $this->rules, $this->error_msg);
        $photo = new Photo();
        $photo -> name = $req->input('name');
        $photo -> description = $req->input('description');
        $photo -> album_id = $req->input('album_id');
        
        if($this->processFile($req, $photo->id, $photo)){

            $photo->save();
            $msg = "Photo " . $photo->name . " inserita";
        } else {
            $msg = "Photo " . $photo->name . " non inserita";
        }
        session()->flash('msg', $msg);
        
        return redirect()->route('images_album', $photo->album_id);
    }

    public function processFile(Request $req, $id, $photo) {
        if (!$req->hasFile('img_path')) {
            return false;
        }
        $file = $req->file('img_path');
        if (!$file->isValid()) {
            return false;
        }
        $file_name = $id ? Str::slug($id . "_" .$req->input('name')) : Str::slug($req->input('name')); 
        $ext = $file->extension();
        $file_path = env('IMG_DIR') . "/". $photo->album_id . '/' . $file_name . '.' . $ext;
        $file->storeAs(env('IMG_DIR') . '/' . $photo->album_id, $file_name . "." . $ext, 'public');
        $photo -> img_path = $file_path;
        return true;
    }

    public function deleteFile($id, $photo) {
        if ($photo->img_path && Storage::disk('public')->exists($photo->img_path)) {
           Storage::disk('public')->delete($photo->img_path);     
        } 
    }


    public function getAlbums() {
        return Album::orderBy('album_name', 'asc')->where('user_id', Auth::user()->id)->get();
    }

}
