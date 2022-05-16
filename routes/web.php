<?php

use Illuminate\Support\Facades\Route;

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


// Auth::routes();

Route::get('login', 'AdminController@login')->name('login');
Route::post('post-login', 'AdminController@postLogin')->name('login.post');
Route::get('logout', 'AdminController@logout')->name('logout');
Route::get('/', 'AdminController@login')->name('home.page');

Route::prefix('admin')->group(function () {
Route::get('/home', 'AdminController@index')->name('home');
//candidate register
Route::get('candidate_register', 'CandidateRegisterController@candidate_register')->name('candidate_register');
Route::post('store', 'CandidateRegisterController@store')->name('candidate.store');
Route::get('/candidate_list', 'CandidateController@list')->name('candidate.list');
Route::get('/candidate_edit/{id}', 'CandidateController@candidate_edit')->name('candidate.edit');
Route::post('/candidate_update', 'CandidateController@candidate_update')->name('candidate.update');
Route::get('/candidate_search', 'CandidateController@candidate_search')->name('candidate.search');
Route::post('/candidate_delete', 'CandidateController@candidate_delete')->name('candidate.delete');
//department 
Route::get('department', 'SettingsController@department')->name('department.list');
Route::get('department_edit/{id}', 'SettingsController@department_edit')->name('department.edit');
Route::post('add_department', 'SettingsController@add_department')->name('department.add');
Route::post('edit_department', 'SettingsController@edit_department')->name('department.edit');
Route::post('update_department', 'SettingsController@update_department')->name('department.update');
Route::post('delete_department', 'SettingsController@delete_department')->name('department.delete');
//designation

Route::get('designation', 'SettingsController@designation')->name('designation.list');
Route::get('department_edit/{id}', 'SettingsController@department_edit')->name('designation.edit');
Route::post('add_designation', 'SettingsController@add_designation')->name('designation.add');
Route::post('edit_designation', 'SettingsController@edit_designation')->name('designation.edit');
Route::post('update_designation', 'SettingsController@update_designation')->name('designation.update');
Route::post('delete_designation', 'SettingsController@delete_designation')->name('designation.delete');
Route::post('get_designation', 'SettingsController@getDesignation')->name('designation.getDesignation');
Route::post('edit_get', 'SettingsController@edit_get')->name('designation.edit_get');
});

//froent url
Route::get('/candidate/{id}', 'CandidateController@index')->name('candidate.test');
Route::post('codeRun', 'CandidateController@codeRun')->name('codeRun');


