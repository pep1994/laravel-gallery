<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/home', 'AlbumsController@index') -> name('albums');
Route::get('/', 'AlbumsController@index') -> name('albums');

Route::get('/albums', 'AlbumsController@index') -> name('albums');

Route::delete('/albums/{id}', 'AlbumsController@delete') -> name('delete_album');

Route::get('/albums/{id}', 'AlbumsController@show') -> name('show_album')->where('id', '[0-9]+');

Route::get('/albums/{id}/edit', 'AlbumsController@edit') -> name('edit_album');

Route::patch('/albums/{id}/update', 'AlbumsController@update') -> name('update_album');

Route::get('/albums/create', 'AlbumsController@create') -> name('create_album');

Route::post('/albums/store', 'AlbumsController@store') -> name('store_album');

Route::get('/usersnoalbum', function () {
    $usernoalbums = DB::table('users')->leftJoin('albums', 'users.id', 'albums.user_id')->select('users.id', 'email', 'name')->whereNull('album_name')->get();
    return $usernoalbums;
});

Route::get('/albums/{id}/images', 'AlbumsController@getImages') -> name('images_album')->where('id', '[0-9]+');

Route::delete('/photos/{id}', 'PhotosController@delete') -> name('delete_photo');

Route::get('/photos/{id}/edit', 'PhotosController@edit') -> name('edit_photo');

Route::patch('/photos/{id}/update', 'PhotosController@update') -> name('update_photo');

Route::get('/photos/create', 'PhotosController@create') -> name('create_photo');

Route::post('/photos/store', 'PhotosController@store') -> name('store_photo');


Auth::routes();


