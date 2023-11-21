<?php

use App\Http\Controllers\WorkingController;
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

Route::middleware('auth.session')->get('/startEnd/{id}',[WorkingController::class,'startEnd'])->name('startEnd');


// Route::get('/startEnd/{id}',[WorkingController::class,'startEnd'])->name('startEnd');
