<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('albums', function (Blueprint $table) {
            $table -> foreign('user_id', 'user') -> references('id') -> on('users') -> onDelete('cascade');
        });

        Schema::table('photos', function (Blueprint $table) {
            $table -> foreign('album_id', 'album') -> references('id') -> on('albums') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->dropForeign('user');
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign('album');
        });
    }
}
