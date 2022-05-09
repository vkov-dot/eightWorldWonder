<?php

use App\Http\Controllers\AddInfoController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaFolderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\HeadingController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StateController;
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



Route::group([
    'as' => 'start.',
    'prefix' => '',
], function () {
    Route::get('/', [StartController::class, 'index'])->name('index');
    Route::get('/create', [StartController::class, 'create'])->name('create');
    Route::post('/', [StartController::class, 'store'])->name('store');
    Route::get('/start/', [StartController::class, 'show'])->name('show');
    Route::get('/{start}/edit', [StartController::class, 'edit'])->name('edit');
    Route::put('/{start}', [StartController::class, 'update'])->name('edit');
    Route::delete('/{start}', [StartController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'issues.',
    'prefix' => 'issues'
], function () {
    Route::get('/', [IssueController::class, 'index'])->name('index');
    Route::get('/create', [IssueController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [IssueController::class, 'store'])->name('store')->middleware('admin');
    Route::post('/search', [IssueController::class, 'search'])->name('search');
    Route::get('/{issue}/', [IssueController::class, 'show'])->name('show');
    Route::get('/{issue}/edit', [IssueController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{issue}', [IssueController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{id}', [IssueController::class, 'destroy'])->name('destroy')->middleware('admin');;
    Route::put('/recover/{id}', [IssueController::class, 'recover'])->name('recover')->middleware('admin');;
});

Route::group([
    'as' => 'categories.',
    'prefix' => 'categories'
], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [CategoryController::class, 'store'])->name('store')->middleware('admin');
    Route::post('/search', [CategoryController::class, 'search'])->name('search');
    Route::get('/{category}/', [CategoryController::class, 'show'])->name('show');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('admin');
});

Route::group([
    'as' => 'media.',
    'prefix' => 'media'
], function () {
    Route::get('/', [MediaFolderController::class, 'index'])->name('index');
    Route::get('/create', [MediaFolderController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [MediaFolderController::class, 'store'])->name('store')->middleware('admin');
    Route::get('/{media}/', [MediaFolderController::class, 'show'])->name('show');
    Route::get('/{media}/edit', [MediaFolderController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{media}', [MediaFolderController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{media}', [MediaFolderController::class, 'destroy'])->name('destroy')->middleware('admin');
});

Route::group([
    'as' => 'photos.',
    'prefix' => 'photos'
], function () {
    Route::get('/', [PhotoController::class, 'index'])->name('index');
    Route::get('/create', [PhotoController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [PhotoController::class, 'store'])->name('store')->middleware('admin');
    Route::get('/{media}/', [PhotoController::class, 'show'])->name('show');
    Route::get('/{media}/edit', [PhotoController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{media}', [PhotoController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{media}', [PhotoController::class, 'destroy'])->name('destroy')->middleware('admin');
});

Route::group([
    'as' => 'videos.',
    'prefix' => 'videos'
], function () {
    Route::get('/', [VideoController::class, 'index'])->name('index');
    Route::get('/create', [VideoController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [VideoController::class, 'store'])->name('store')->middleware('admin');
    Route::get('/{media}/', [VideoController::class, 'show'])->name('show');
    Route::get('/{media}/edit', [VideoController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{media}', [VideoController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{media}', [VideoController::class, 'destroy'])->name('destroy')->middleware('admin');
});

Route::group([
    'as' => 'headings.',
    'prefix' => 'headings',
], function () {
    Route::get('/', [HeadingController::class, 'index'])->name('index');
    Route::get('/create', [HeadingController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [HeadingController::class, 'store'])->name('store')->middleware('admin');
    Route::get('/{heading}/', [HeadingController::class, 'show'])->name('show');
    Route::get('/{heading}/edit', [HeadingController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{heading}', [HeadingController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{heading}', [HeadingController::class, 'destroy'])->name('destroy')->middleware('admin');
});

Route::group([
   'as' => 'states.',
   'prefix' => 'states'
], function () {
    Route::get('/', [StateController::class, 'index'])->name('index');
    Route::get('/create', [StateController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [StateController::class, 'store'])->name('store')->middleware('admin');
    Route::post('/search', [StateController::class, 'search'])->name('search');
    Route::get('/{state}/', [StateController::class, 'show'])->name('show');
    Route::get('/{state}/edit', [StateController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{state}', [StateController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{id}', [StateController::class, 'destroy'])->name('destroy')->middleware('admin');
    Route::put('/recover/{id}', [StateController::class, 'recover'])->name('recover')->middleware('admin');
});

Route::group([
    'as' => 'archives.',
    'prefix' => 'archives'
], function () {
    Route::get('/', [ArchiveController::class, 'index'])->name('index')->middleware('admin');
    Route::get('/create', [ArchiveController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [ArchiveController::class, 'store'])->name('store')->middleware('admin');
    Route::post('/search', [ArchiveController::class, 'search'])->name('search')->middleware('admin');
    Route::get('/{table}', [ArchiveController::class, 'show'])->name('show')->middleware('admin');
    Route::get('/{table}/edit', [ArchiveController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{table}', [ArchiveController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{table}/{id}', [ArchiveController::class, 'destroy'])->name('destroy')->middleware('admin');
    Route::put('/{table}/{id}', [ArchiveController::class, 'recover'])->name('recover')->middleware('admin');
});

Route::get('/addInfo', [AddInfoController::class, 'index'] )->name('addInfo')->middleware('admin');

Auth::routes();

Route::get('/home', [StartController::class, 'index'])->name('home');


