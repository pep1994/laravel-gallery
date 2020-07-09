<?php

use Illuminate\Database\Seeder;
use App\AlbumCategory;

class AlbumCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $img = [
            "abstract",
            "animals",
            "business",
            "cats",
            "city",
            "food",
            "fashion",
            "people",
            "nature",
            "sports",
            "technics",
            "transport"
        ];

        foreach ($img as $image) {
            AlbumCategory::create([
                'category_name' => $image
            ]);
        }
    }
}
