<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name', 64)->unique();
            $table->timestamps();
        });

        Schema::create('album_category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('album_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->unique(['category_id', 'album_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_categories');
    }
}
