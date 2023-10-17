<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeadLineController;
use App\Http\Controllers\EducationLevelController;
use App\Http\Controllers\NoWordsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaperTypeController;
use App\Http\Controllers\ReferenceStyleController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('logout', [AuthController::class, 'logout']);

    // Route::resource('dead_lines', DeadLineController::class);
    // Route::resource('education_levels', EducationLevelController::class);
    // Route::resource('no_words', NoWordsController::class);
    // Route::resource('orders', OrderController::class);
    // Route::resource('paper_type', PaperTypeController::class);
    // Route::resource('reference_style', ReferenceStyleController::class);
    // Route::resource('subject', SubjectController::class);
   
    

});


