<?php

use App\Http\Controllers\API\QuisionareController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\NoteUserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
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

Route::get('/',  [UserController::class, 'index']);
Route::post('/login',  [UserController::class, 'authenticate']);
Route::group(['middleware' => ['admin']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::resource('artikel', ArtikelController::class);
    Route::resource('expert', ExpertController::class);
    Route::resource('note', NoteUserController::class);
    Route::resource('kuesioner', QuestionController::class);
    Route::post('/updateChoice/{idQuestion}', [QuestionController::class, 'updateChoice']);
    Route::post('/addChoice/{idQuestion}', [QuestionController::class, 'addChoice']);
    Route::delete('/deleteChoice/{id}', [QuestionController::class, 'deleteChoice']);
});
