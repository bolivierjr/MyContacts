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
    return redirect('contacts');
});

Route::get('api/contacts', 'ContactController@getJson');

Auth::routes();

Route::resource('contacts', 'ContactController');

Route::post('contacts/new-email/{id}', ['uses' => 'AddFormController@addEmail'])->name('contacts.email');
Route::post('contacts/new-phone/{id}', ['uses' => 'AddFormController@addPhone'])->name('contacts.phone');

Route::post('contacts/delete-email/{id}/{index}', ['uses' => 'AddFormController@deleteEmail'])->name('contacts.deleteemail');
Route::post('contacts/delete-phone/{id}/{index}', ['uses' => 'AddFormController@deletePhone'])->name('contacts.deletephone');
