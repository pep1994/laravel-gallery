<?php

use Illuminate\Support\Facades\Route;

Route::get('/albums', 'AlbumsController@index') -> name('albums');

Route::delete('/albums/{id}', 'AlbumsController@delete') -> name('delete_album');

Route::get('/albums/{id}', 'AlbumsController@show') -> name('show_album')->where('id', '[0-9]+');

Route::get('/albums/{id}/edit', 'AlbumsController@edit') -> name('edit_album');

Route::patch('/albums/{id}/update', 'AlbumsController@update') -> name('update_album');

Route::get('/albums/create', 'AlbumsController@create') -> name('create_album');

Route::post('/albums/store', 'AlbumsController@store') -> name('store_album');