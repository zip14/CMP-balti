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

Route::get('/', 'PagesController@homePage')->name('homePage');
Route::get('news/', 'PagesController@newsPage')->name('newsPage');
Route::get('gallary/', 'PagesController@gallaryPage')->name('gallaryPage');
Route::get('about/', 'PagesController@aboutPage')->name('aboutPage');
Route::get('contact/', 'PagesController@contactPage')->name('contactPage');
Route::get('specialty/', 'PagesController@specialtyPage')->name('specialtyPage');
Route::get('team/', 'PagesController@teamPage')->name('teamPage');

Route::get('specialty/{specialty}', 'PagesController@fullSpecialtyPage')->name('fullSpecialtyPage');
Route::get('news/{news}', 'PagesController@fullNewsPage')->name('fullNewsPage');
Route::get('news/category/{category}', 'PagesController@categoryNewsPage')->name('categoryNewsPage');
Route::get('team/{team}', 'PagesController@fullTeamPage')->name('fullTeamPage');

Route::post('comments/store', 'CommentController@store')->name('comments.store');

Route::get('login', 'UsersController@login')->name('myLogin');
Route::post('login', 'UsersController@authenticate')->name('login');

Route::post('/admin', 'UsersController@authenticate')->name('authenticate');

Route::get('/logout', 'UsersController@logout')->name('logout');
Route::get('/logout-form', 'UsersController@logoutForm')->name('logoutForm');

Route::group(['prefix'=>'admin-panel', 'middleware'=>'auth'], function (){

    Route::get('/', 'NewsController@index');

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

    //Team
    Route::post('team/select', 'TeamController@selectPerson')->name('team.list');
    Route::get('team/{team}/delete', 'TeamController@delete')->name('team.delete');
    Route::resource('team', 'TeamController');

    //Users
    Route::get('users/profile', 'UsersController@profile')->name('users.profile');
    Route::post('users/select', 'UsersController@selectUsers')->name('users.list');
    Route::get('users/{users}/delete', 'UsersController@delete')->name('users.delete');
    Route::get('users/{users}/password', 'UsersController@password')->name('users.password');
    Route::post('users/{users}/change-password', 'UsersController@changePassword')->name('users.change-password');
    Route::resource('users', 'UsersController');

    //Comments
    Route::get('comments/{comments}/delete', 'CommentController@delete')->name('comments.delete');
    Route::delete('comments/{comments}', 'CommentController@destroy')->name('comments.destroy');
    Route::post('comments/select', 'CommentController@selectComments')->name('comments.list');
    Route::get('comments/', 'CommentController@index')->name('comments.index');

});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
