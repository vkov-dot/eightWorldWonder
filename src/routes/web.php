<?php

use App\Http\Controllers\AddInfoController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\MediaFolderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\HeadingController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\Activate;
use App\Repositories\IssueRepository;
use App\Repositories\StateRepository;
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
    Route::get('/{category}/', [CategoryController::class, 'show'])->name('show');
});

Route::group([
    'as' => 'photos.',
    'prefix' => 'photos'
], function () {
    Route::get('/create', [PhotoController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [PhotoController::class, 'store'])->name('store')->middleware('admin');
    Route::delete('/{photo}', [PhotoController::class, 'destroy'])->name('destroy')->middleware('admin');
});

Route::group([
    'as' => 'videos.',
    'prefix' => 'videos'
], function () {
    Route::get('/create', [VideoController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [VideoController::class, 'store'])->name('store')->middleware('admin');
    Route::delete('/{video}', [VideoController::class, 'destroy'])->name('destroy')->middleware('admin');
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
});

Route::group([
   'as' => 'states.',
   'prefix' => 'states'
], function () {
//    Route::get('/', [StateController::class, 'index'])->name('index');
    Route::get('/create', [StateController::class, 'create'])->name('create')->middleware('admin');
    Route::post('/', [StateController::class, 'store'])->name('store')->middleware('admin');
    Route::post('/search', [StateController::class, 'search'])->name('search');
    Route::post('/sort', [StateController::class, 'sort'])->name('sort');
//    Route::get('/{state}/', [StateController::class, 'show'])->name('show');
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

Route::group([
    'as' => 'archived.',
    'prefix' => 'archived'
], function () {
    Route::get('/{table}', [ArchiveController::class, 'show'])->name('show')->middleware('admin');
    Route::delete('/{table}/{id}', [ArchiveController::class, 'destroy'])->name('destroy')->middleware('admin');
});

Route::group([
    'as' => 'users.',
    'prefix' => 'users'
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index')->middleware('admin');
    Route::post('/search', [UserController::class, 'search'])->name('search')->middleware('admin');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit')->middleware('admin');
    Route::put('/{user}', [UserController::class, 'update'])->name('update')->middleware('admin');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy')->middleware('admin');
});

Route::group([
    'as' => 'profiles.',
    'prefix' => 'profiles'
], function () {
    Route::get('/', [ProfileController::class, 'show'])->name('show')->middleware('auth');
    Route::get('{profile}/edit', [ProfileController::class, 'edit'])->name('edit')->middleware('auth');
    Route::put('/update', [ProfileController::class, 'update'])->name('update')->middleware('auth');
});

Route::group([
    'as' => 'rating.',
    'prefix' => 'rating'
], function () {
    Route::post('/store', [RatingController::class, 'store'])->name('store')->middleware('auth');
});

Route::get('/addInfo', [AddInfoController::class, 'index'] )->name('addInfo')->middleware('admin');

Auth::routes();

Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware(Activate::class);
Route::get('/home', [StartController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'verification'
], function () {
    Route::post('/', [EmailVerificationController::class, 'verify'])->name('verification');
    Route::post('/reset', [EmailVerificationController::class, 'reset'])->name('verification.reset');
    Route::post('/activate', [EmailVerificationController::class, 'activate'])->name('verification.activate');
});

Route::get('/home', [App\Http\Controllers\StartController::class, 'index'])->name('home');
