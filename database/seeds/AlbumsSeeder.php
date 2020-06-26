<?php

use Illuminate\Database\Seeder;
use App\Album;
use App\User;

class AlbumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Album::class, 10) -> make() -> each(function($album) {
            $user = User::inRandomOrder() -> first();
            $album -> user() -> associate($user);
            $album -> save();
        });
    }
}
