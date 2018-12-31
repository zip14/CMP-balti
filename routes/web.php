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

//Gallary-category
Route::post('gallary-category/select', 'GallaryCategoryController@selectCategories')->name('gallary-category.list');
Route::get('gallary-category/{gallary_category}/delete', 'GallaryCategoryController@delete')->name('gallary-category.delete');
Route::resource('gallary-category', 'GallaryCategoryController');


//Gallary
Route::post('gallary/select', 'GallaryController@selectGallary')->name('gallary.list');
Route::get('gallary/{gallary}/delete', 'GallaryController@delete')->name('gallary.delete');
Route::resource('gallary', 'GallaryController');


//News-category
Route::post('news-category/select', 'NewsCategoryController@selectCategories')->name('news-category.list');
Route::get('news-category/{news_category}/delete', 'NewsCategoryController@delete')->name('news-category.delete');
Route::resource('news-category', 'NewsCategoryController');


//News
Route::post('news/select', 'NewsController@selectNews')->name('news.list');
Route::get('news/{news}/delete', 'NewsController@delete')->name('news.delete');
Route::resource('news', 'NewsController');

//Specialty
Route::post('specialty/select', 'SpecialtyController@selectSpecialty')->name('specialty.list');
Route::get('specialty/{specialty}/delete', 'SpecialtyController@delete')->name('specialty.delete');
Route::resource('specialty', 'SpecialtyController');