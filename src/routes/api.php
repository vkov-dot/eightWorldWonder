<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HeadingController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaFolderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', [StartController::class, 'index'])->name('index');

Route::group([
    'as' => 'states.',
    'prefix' => 'states'
], function () {
    Route::get('/latest', [StateController::class, 'lastStates'])->name('latest');
    Route::get('/', [StateController::class, 'index'])->name('index');

    Route::get('/create', [StateController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [StateController::class, 'store'])->name('store')->middleware('admin');
    Route::post('/search', [StateController::class, 'search'])->name('search');
    Route::post('/sort', [StateController::class, 'sort'])->name('sort');
    Route::get('/{state}', [StateController::class, 'show']);
    Route::get('/{state}/edit', [StateController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{state}', [StateController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{id}', [StateController::class, 'destroy'])->name('destroy')->middleware('admin');
    Route::put('/recover/{id}', [StateController::class, 'recover'])->name('recover')->middleware('admin');

    Route::group([
        'as' => 'comments.',
        'prefix' => '{state}/comments'
    ], function () {
        Route::post('/store', [CommentController::class, 'store'])->name('store')->middleware('auth');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy')->middleware('auth');
    });
});

Route::get('issues/categories/{category}/', [CategoryController::class, 'show'])->name('show');

Route::group([
    'as' => 'media.',
    'prefix' => 'media'
], function () {
    Route::get('/', [MediaFolderController::class, 'index'])->name('index');
    Route::get('/create', [MediaFolderController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [MediaFolderController::class, 'store'])->name('store')->middleware('admin');
    Route::get('/{media}/', [MediaFolderController::class, 'show'])->name('show');
    Route::delete('/{media}', [MediaFolderController::class, 'destroy'])->name('destroy')->middleware('admin');
});

Route::get('/issues/latest', [IssueController::class, 'lastIssues'])->name('getLatestIssues');

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
});
