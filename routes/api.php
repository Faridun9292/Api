<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\NotebookController;

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

Route::prefix('/v1/notebook')->group(function (){
    Route::get('/', [NotebookController::class, 'index']);
    Route::post('/', [NotebookController::class, 'store']);
    Route::get('/{id}', [NotebookController::class, 'edit']);
    Route::post('/{id}', [NotebookController::class, 'update']);
    Route::delete('/{id}', [NotebookController::class, 'destroy']);
});

