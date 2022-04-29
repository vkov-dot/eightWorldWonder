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
    Route::get('/create', [IssueController::class, 'create'])->name('create');
    Route::post('/', [IssueController::class, 'store'])->name('store');
    Route::post('/search', [IssueController::class, 'search'])->name('search');
    Route::get('/{issue}/', [IssueController::class, 'show'])->name('show');
    Route::get('/{issue}/edit', [IssueController::class, 'edit'])->name('edit');
    Route::put('/{issue}', [IssueController::class, 'update'])->name('edit');
    Route::delete('/{issue}', [IssueController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'categories.',
    'prefix' => 'categories'
], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::post('/search', [CategoryController::class, 'search'])->name('search');
    Route::get('/{category}/', [CategoryController::class, 'show'])->name('show');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('edit');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'media.',
    'prefix' => 'media'
], function () {
    Route::get('/', [MediaFolderController::class, 'index'])->name('index');
    Route::get('/create', [MediaFolderController::class, 'create'])->name('create');
    Route::post('/', [MediaFolderController::class, 'store'])->name('store');
    Route::get('/{media}/', [MediaFolderController::class, 'show'])->name('show');
    Route::get('/{media}/edit', [MediaFolderController::class, 'edit'])->name('edit');
    Route::put('/{media}', [MediaFolderController::class, 'update'])->name('edit');
    Route::delete('/{media}', [MediaFolderController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'headings.',
    'prefix' => 'headings',
], function () {
    Route::get('/', [HeadingController::class, 'index'])->name('index');
    Route::get('/create', [HeadingController::class, 'create'])->name('create');
    Route::post('/', [HeadingController::class, 'store'])->name('store');
    Route::get('/{heading}/', [HeadingController::class, 'show'])->name('show');
    Route::get('/{heading}/edit', [HeadingController::class, 'edit'])->name('edit');
    Route::put('/{heading}', [HeadingController::class, 'update'])->name('edit');
    Route::delete('/{heading}', [HeadingController::class, 'destroy'])->name('destroy');
});

Route::group([
   'as' => 'states.',
   'prefix' => 'states'
], function () {
    Route::get('/', [StateController::class, 'index'])->name('index');
    Route::get('/create', [StateController::class, 'create'])->name('create');
    Route::post('/', [StateController::class, 'store'])->name('store');
    Route::post('/search', [StateController::class, 'search'])->name('search');
    Route::get('/{state}/', [StateController::class, 'show'])->name('show');
    Route::get('/{state}/edit', [StateController::class, 'edit'])->name('edit');
    Route::put('/{state}', [StateController::class, 'update'])->name('update');
    Route::delete('/{state}', [StateController::class, 'destroy'])->name('destroy');
});


Route::get('/addInfo', [AddInfoController::class, 'index'] )->name('addInfo');

Auth::routes();

Route::get('/home', [StartController::class, 'index'])->name('home');

Route::group([
    'as' => 'archives.',
    'prefix' => 'archives'
], function () {
    Route::get('/', [ArchiveController::class, 'index'])->name('index');
    Route::get('/create', [ArchiveController::class, 'create'])->name('create');
    Route::post('/', [ArchiveController::class, 'store'])->name('store');
    Route::post('/search', [ArchiveController::class, 'search'])->name('search');
    Route::get('/{table}', [ArchiveController::class, 'show'])->name('show');
    Route::get('/{table}/edit', [ArchiveController::class, 'edit'])->name('edit');
    Route::put('/{table}', [ArchiveController::class, 'update'])->name('update');
    Route::delete('/{table}/{id}', [ArchiveController::class, 'destroy'])->name('destroy');
    Route::put('/{table}/{id}', [ArchiveController::class, 'recover'])->name('recover');
});

