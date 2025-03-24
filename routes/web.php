<?php

use App\Modules\Authors\Infrastructure\Adapters\Http\AuthorController;
use App\Modules\Books\Infrastructure\Adapters\Http\BookController;
use App\Modules\Reports\Infrastructure\Adapters\Http\BookReportController;
use App\Modules\Subjects\Infrastructure\Adapters\Http\SubjectsController;
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

Route::get('/', function () {
    return redirect()->route('books.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('subjects', SubjectsController::class);
    Route::get('generate-pdf', [BookReportController::class, 'generate'])->name('generate-pdf');
});

