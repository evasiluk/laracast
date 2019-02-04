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
    return view('home');
});

Route::get("/faq", "QuestionsController@index");
Route::get("/personal", "QuestionsController@personal");
Route::get("/notifications", "NotificationsController@personal");
Route::get("/ask", "QuestionsController@create");
Route::post("/ask", "QuestionsController@store");
Route::get("/admin", "AdminController@index");
Route::get("/admin/{question}/edit", "AdminController@edit");
Route::post("/admin/{question}/edit", "AdminController@update");
Route::post('/votes/{question}', 'VotesController@store');
Route::post('/admin/settings', 'SettingsController@update');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
