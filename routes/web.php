<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/users', 'AdminController@users')->name('users');
Route::get('/users/add', 'AdminController@addUser')->name('addUser');
Route::post('/users/add', 'AdminController@saveUser')->name('saveUser');
Route::get('/users/edit/{id}', 'AdminController@editUser')->name('editUser');
Route::post('/users/edit/{id}', 'AdminController@saveEditedUser')->name('saveEditedUser');

Route::get('/patients', 'PatientsController@patients')->name('patients');
Route::get('/patients/add', 'PatientsController@addPatient')->name('addPatient');
Route::post('/patients/add', 'PatientsController@savePatient')->name('savePatient');
Route::get('/patients/edit/{id}', 'PatientsController@editPatient')->name('editPatient');
Route::post('/patients/edit/{id}', 'PatientsController@saveEditedPatient')->name('saveEditedPatient');

Route::get('/courses', 'CoursesController@courses')->name('courses');
Route::get('/courses/add', 'CoursesController@addCourse')->name('addCourse');
Route::post('/courses/add', 'CoursesController@saveCourse')->name('saveCourse');
Route::get('/statistics', 'CoursesController@statistics')->name('statistics');

Route::get('/treatments', 'TreatmentController@treatments')->name('treatments');
Route::post('/patients/{id}', 'TreatmentController@addTreatment')->name('addTreatment');
Route::post('/treatments/{id}', 'TreatmentController@updateTreatment')->name('updateTreatment');
Route::get('/treatments/export/{id}', 'TreatmentController@exportTreatment')->name('exportTreatment');