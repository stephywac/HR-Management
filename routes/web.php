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

Route::get('/', 'HomeController@index')->name('home.page');
// Auth::routes();
Route::get('login', 'AdminController@login')->name('login');
Route::post('post-login', 'AdminController@postLogin')->name('login.post'); 
Route::get('logout', 'AdminController@logout')->name('logout');
Route::get('/home', 'AdminController@index')->name('home');
Route::get('candidate_register', 'CandidateRegisterController@candidate_register')->name('candidate_register');
Route::post('store', 'CandidateRegisterController@store')->name('candidate.store');
Route::get('/candidate', 'CandidateController@index')->name('candidate');
Route::post('codeRun', 'CandidateController@codeRun')->name('codeRun');