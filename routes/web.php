<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('gallary-category/select', 'GallaryCategoryController@selectArticle')->name('gallary-category.list');
Route::get('gallary-category/{gallary_category}/delete', 'GallaryCategoryController@delete')->name('gallary-category.delete');
Route::resource('gallary-category', 'GallaryCategoryController');



Route::post('gallary/select', 'GallaryController@selectGallary')->name('gallary.list');
Route::get('gallary/{gallary}/delete', 'GallaryController@delete')->name('gallary.delete');
Route::resource('gallary', 'GallaryController');
