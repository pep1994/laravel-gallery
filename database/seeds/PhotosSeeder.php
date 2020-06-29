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
        $albums = Album::get();
        foreach ($albums as $album) {
            factory(Photo::class, 200) -> create(
                ['album_id' => $album->id]
            );
        }
    }
}
