<?php


use App\Http\Controllers\WorkerController;
use App\Http\Controllers\WorkingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/',[WorkerController::class,'importView'])->name('import-view');
Route::post('/import',[WorkerController::class,'import'])->name('import');
Route::post('/enter', [WorkerController::class, 'enter'])->name('enter');





