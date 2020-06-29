<?php

namespace App;
use App\Photo;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['id'];
    protected $table = 'albums';

    public function photos() {
        return $this->hasMany(Photo::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
