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

//Route::get('/', 'main@index');
Route::get('/',function (){
    return redirect('login');
});

Route::get('test','main@getlist');
Route::post('/certificate', 'main@GetRop')->name('register');
Route::get('list','main@showList');
Route::get('list/getlist', ['as'=>'list.getlist','uses'=>'main@getlist']);
Route::get('profile', 'student@index');
Route::get('/User/userList','UserController@loadUserData')->name('userlist');


Route::get('/User','UserController@index');

Route::get('delete/{id}','UserController@DeleteUser');

Route::get('editUser','UserController@editeUser');

Route::post('SaveUser','UserController@saveUser');

Route::get('/adduser','UserController@AddUser');

Route::post('/addUser','UserController@create');

Route::get('/Certificates','Certificate@index');

Route::get('/Certificates/certificateslist','Certificate@LoadCertificate')->name('certificateslist');



Auth::routes();

Route::get('/home', 'HomeController@index');

