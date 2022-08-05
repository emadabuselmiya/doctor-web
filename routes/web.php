<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;


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

Route::post('/message', 'IndexController@storeMessage')->name('home.messages');

Route::get('/', 'IndexController@index')->name('home.index');
Route::get('/contact', 'IndexController@contact')->name('home.contact');
Route::get('/services/{id}', 'IndexController@show')->name('home.services.show');

Route::get('/admin/profile', 'IndexController@profile')->middleware(['auth', 'verified']);


Route::post('/appointment', 'IndexController@storeAppointment')->name('home.appointment');





Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
     'middleware' => ['auth'],

], function () {
    Route::resource('/users', 'UsersController');
    Route::resource('/sliders', 'SlidersController');
    Route::resource('/services', 'ServicesController');
    Route::resource('/doctors', 'DoctorsController');
    Route::resource('/gallaries', 'GallariesController');
    Route::resource('/contacts', 'ContactsController');
    Route::resource('/clients', 'ClientsController');
    Route::resource('/messages', 'MessagesController');
    Route::resource('/appointments', 'AppointmentsController');
    Route::delete('/sliders', 'SlidersController@delete')->name('sliders.delete');
    Route::delete('/gallaries', 'GallariesController@delete')->name('gallaries.delete');

    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('/profile', 'AdminController@profile')->name('profile');
});
// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
