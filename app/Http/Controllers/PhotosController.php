<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use Str;
use Storage;

class PhotosController extends Controller
{
    public function index() {

    }

    public function show() {

    }

    public function delete($id) {

        $photo = Photo::findOrFail($id);
        $res = $photo->delete();

        if ($res) {
            $this->deleteFile($id);
        }
        return $res;
    }

    public function edit($id) {
        $photo = Photo::findOrFail($id);
        return view('pages.edit_image')->with('photo', $photo);
    }

    public function update(Request $req, $id) {
        $data = $req->only(['name', 'description']);
        $photo = Photo::findOrFail($id);
        $photo_update = Photo::where('id', $id)->update([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
        if ($this->processFile($req, $id, $photo)) {
            
           $photo->save();
        }
        $msg = $photo_update ? 'Image ' . $photo->name . ' aggiornata' : 'Image ' . $photo->name . ' non aggiornata';
        session()->flash('msg', $msg);
        return redirect()->route('images_album', $photo->album_id);
    }

    public function processFile(Request $req, $id, $photo) {
        if ($req->file('img_path ')) {
            return false;
        }
        $file = $req->file('img_path');
        if (!$file->isValid()) {
            return false;
        }
        $file_name = Str::slug($id . "_" .$req->input('name')); 
        $ext = $file->extension();
        $file_path = env('IMG_DIR') . "/". $photo->album_id . '/' . $file_name . '.' . $ext;
        $file->storeAs(env('IMG_DIR') . '/' . $photo->album_id, $file_name . "." . $ext, 'public');
        $photo -> img_path = $file_path;
        return true;
    }

    public function deleteFile($id) {
        $photo = Photo::findOrFail($id);
        if ($photo->img_path && Storage::disk('public')->exists($photo->img_path)) {
           return Storage::disk('public')->delete($photo->img_path);     
        }
        return false;
    }

}
