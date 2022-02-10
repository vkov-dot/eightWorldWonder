<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HeadingController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StateController as StateController;
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


Route::get('/', function () {
    return view('start');
});

Route::group([
    'as' => 'start.',
    'prefix' => 'start'
], function () {
    Route::get('/', [Controller::class, 'index'])->name('index');
    Route::put('/create', [Controller::class, 'create'])->name('create');
    Route::post('/', [Controller::class, 'store'])->name('store');
    Route::put('/{start}', [Controller::class, 'show'])->name('show');
    Route::get('/{start}/edit', [Controller::class, 'edit'])->name('edit');
    Route::put('/{start}', [Controller::class, 'update'])->name('edit');
    Route::delete('/{start}', [Controller::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'issues.',
    'prefix' => 'issues'
], function () {
    Route::get('/', [IssueController::class, 'index'])->name('index');
    Route::put('/create', [IssueController::class, 'create'])->name('create');
    Route::post('/', [IssueController::class, 'store'])->name('store');
    Route::put('/{issue}', [IssueController::class, 'show'])->name('show');
    Route::get('/{issue}/edit', [IssueController::class, 'edit'])->name('edit');
    Route::put('/{issue}', [IssueController::class, 'update'])->name('edit');
    Route::delete('/{issue}', [IssueController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'media.',
    'prefix' => 'media'
], function () {
    Route::get('/', [MediaController::class, 'index'])->name('index');
    Route::put('/create', [MediaController::class, 'create'])->name('create');
    Route::post('/', [MediaController::class, 'store'])->name('store');
    Route::put('/{media}', [MediaController::class, 'show'])->name('show');
    Route::get('/{media}/edit', [MediaController::class, 'edit'])->name('edit');
    Route::put('/{media}', [MediaController::class, 'update'])->name('edit');
    Route::delete('/{media}', [MediaController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'headings.',
    'prefix' => 'headings'
], function () {
    Route::get('/', [HeadingController::class, 'index'])->name('index');
    Route::put('/create', [HeadingController::class, 'create'])->name('create');
    Route::post('/', [HeadingController::class, 'store'])->name('store');
    Route::put('/{heading}', [HeadingController::class, 'show'])->name('show');
    Route::get('/{heading}/edit', [HeadingController::class, 'edit'])->name('edit');
    Route::put('/{heading}', [HeadingController::class, 'update'])->name('edit');
    Route::delete('/{heading}', [HeadingController::class, 'destroy'])->name('destroy');
});

Route::group([
   'as' => 'states.',
   'prefix' => 'states'
], function () {
    Route::get('/', [StateController::class, 'index'])->name('index');
    Route::put('/create', [StateController::class, 'create'])->name('create');
    Route::post('/', [StateController::class, 'store'])->name('store');
    Route::put('/{state}', [StateController::class, 'show'])->name('show');
    Route::get('/{state}/edit', [StateController::class, 'edit'])->name('edit');
    Route::put('/{state}', [StateController::class, 'update'])->name('edit');
    Route::delete('/{state}', [StateController::class, 'destroy'])->name('destroy');
});
