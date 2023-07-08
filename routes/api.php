<?php

use App\Http\Controllers\API\MasterController;
use App\Http\Controllers\API\NoteUserController;
use App\Http\Controllers\API\QuisionareController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('sendListener', [UserController::class, 'testSend']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('updateProfil', [UserController::class, 'update']);
    Route::get('expert', [MasterController::class, 'listExpert']);
    Route::get('dashboard', [UserController::class, 'getDataDashboard']);
    Route::get('userData', [UserController::class, 'getUser']);
    Route::post('note', [NoteUserController::class, 'add']);
    Route::get('deleteNote/{id}', [NoteUserController::class, 'delete']);
    Route::get('listNote', [NoteUserController::class, 'list']);
    Route::get('artikel', [MasterController::class, 'listArtikel']);
    Route::get('artikel/{id}', [MasterController::class, 'detailArtikel']);
    Route::post('komen', [MasterController::class, 'postKomen']);
    Route::post('like/{id}', [MasterController::class, 'likeArtikel']);
    Route::get('listQuestion/{id}', [QuisionareController::class, 'listQuestion']);
    Route::get('listCategory', [QuisionareController::class, 'listCategory']);
    Route::post('submitScreening', [QuisionareController::class, 'saveScreening']);
    // Route::resource('products', ProductController::class);
});
