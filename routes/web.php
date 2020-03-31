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

//Route to access welcome page
Route::get('/', function () {
    return view('welcome');
});


//Route for authentication
Auth::routes();

//Route to access home page
Route::get('/home', 'HomeController@index')->name('home');

//Route to store a book in the database
Route::post('/addBook', 'BookController@store');

//Route to access add book page
Route::get('/addBook', 'BookController@create')->name('addBook');

//Route to access book list
Route::get('/bookList', 'BookController@index')->name('bookList');

//Route to access book details
Route::get('/book/{book}', 'BookController@show')->name('book');

//Route to update (add rating) the book
Route::put('/book/{book}', 'RatingController@store');
