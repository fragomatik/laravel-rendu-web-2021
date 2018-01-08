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

use App\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index');

//Routes pour les resources controllers
Route::resource('article', 'ArticleController');
Route::resource('administrateur', 'AdminController');
Route::resource('contact', 'ContactController');
Route::resource('like', 'LikeController');

//Routes pour les commentaires
Route::post('commentary/{article_id}-store','CommentaryController@store')->name('commentary.store');
Route::delete('commentary/{article_id}','CommentaryController@destroy')->name('commentary.destroy');
Route::put('commentary/{com_id}/{article_id}','CommentaryController@update')->name('commentary.update');

//Routes pour le profil utilisateur
Route::get('profile', 'UserController@profile')->name('profile');
Route::get('profile/update-picture', 'UserController@picture')->name('update-picture');
Route::post('profile/update-picture', 'UserController@update');

//Messagerie
Route::get('members','MessageController@index')->name('members');
Route::post('members/contact-store/{user_id_to}/{conversation_id}','MessageController@store')->name('members.store');
Route::get('members/conversation/{user_id_to}','MessageController@conversation')->name('members.conv');


