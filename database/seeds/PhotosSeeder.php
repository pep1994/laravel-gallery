<?php

use Illuminate\Database\Seeder;
use App\Photo;
use App\Album;

class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Photo::class, 200) -> make() -> each(function($photo) {
            $album = Album::inRandomOrder() -> first();
            $photo -> album() -> associate($album);
            $photo -> save();
        });
    }
}
