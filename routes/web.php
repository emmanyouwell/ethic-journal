<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\PDFController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');

Route::resource('journal', JournalController::class)->middleware('auth');
Route::post('/save', [JournalController::class, 'saveEntry'])->middleware('auth')->name('journal.saveEntry');
Auth::routes();
Route::get('/export',[JournalController::class, 'index'])->middleware('auth')->name('export');
Route::get('/delete/{id}',[JournalController::class,'destroy'])->middleware('auth')->name('journal.delete');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
