<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

// Open the index.blade.php
Route::get('/', [TaskController::class, 'index'])->name('index');

# Creat / Insert
Route::post('/store', [TaskController::class, 'store'])->name('store');
Route::get('{id}/edit', [TaskController::class, 'edit'])->name('edit');

#Update 1 record
Route::patch('{id}/update', [TaskController::class, 'update'])->name('update');

Route::delete('{id}/destroy', [TaskController::class, 'destroy'])->name('destroy');