<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;

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

    public function processFile($id, $photo, Request $req = null) {
        if (!$req) {
            $req = request();
        }
        if (!$req->hasFile('img_path ')) {
            return false;
        }

        $file = $req->file('img_path');
        if (!$file->isValid()) {
            return false;
        }
        $file_name = Str::slug($id . "_" .$req->input('name')); 
        $ext = $file->extension();
        $file_path = env('IMG_DIR') . "/" . $file_name . '.' . $ext;
        $file->storeAs(env('IMG_DIR'), $file_name . "." . $ext, 'public');
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
