<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AuthController,TodoController,TaskController};


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

Route::group(['prefix' => 'v1', 'middleware' => 'api', 'namespace' => 'Api'], function ($router) {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function ($router) {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::group(['prefix' => 'to-do'], function ($router){
            Route::get('/', [TodoController::class, 'index']);
            Route::post('/', [TodoController::class, 'store']);
            Route::put('/{todo}', [TodoController::class, 'update']);
            Route::get('/{todo}', [TodoController::class, 'show']);
            Route::delete('/{todo}', [TodoController::class, 'destroy']);
            Route::post('/make-pdf', [TodoController::class, 'makePdf']);

        });

        Route::group(['prefix' => 'task'], function ($router){
            Route::get('/', [TaskController::class, 'index']);
            Route::post('/', [TaskController::class, 'store']);
            Route::put('/{task}', [TaskController::class, 'update']);
            Route::get('/{task}', [TaskController::class, 'show']);
            Route::delete('/{task}', [TaskController::class, 'destroy']);
            Route::post('/file-upload', [TaskController::class, 'fileUpload']);

        });

    });

});

