<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\HeadingController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/all', [StateController::class, 'index'])->name('index');
    Route::get('/create', [StateController::class, 'create'])->name('create')->middleware(['auth:sanctum', 'admin']);
    Route::post('/store', [StateController::class, 'store'])->name('store')->middleware(['auth:sanctum', Admin::class]);
    Route::get('/{state}/show', [StateController::class, 'show']);
    Route::get('/{state}/edit', [StateController::class, 'edit'])->name('edit')->middleware(['auth:sanctum', Admin::class]);
    Route::post('/update/{state}', [StateController::class, 'update'])->name('update')->middleware(['auth:sanctum', Admin::class]);
    Route::post('/archive/add/{id}', [StateController::class, 'toArchive'])->name('archive.add')->middleware(['auth:sanctum', Admin::class]);
    Route::delete('/{id}', [StateController::class, 'destroy'])->name('destroy')->middleware(['auth:sanctum', Admin::class]);
    Route::put('/recover/{id}', [StateController::class, 'recover'])->name('recover')->middleware(['auth:sanctum', Admin::class]);
    Route::post('/rating/store', [RatingController::class, 'store'])->name('store')->middleware('auth:sanctum');

    Route::group([
        'as' => 'comments.',
        'prefix' => '{state}/comments'
    ], function () {
        Route::post('/store', [CommentController::class, 'store'])->name('store')->middleware('auth:sanctum');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy')->middleware('auth:sanctum');
    });
});

Route::get('issues/categories/{category}/', [CategoryController::class, 'show'])->name('show');

Route::group([
    'as' => 'media.',
    'prefix' => 'media'
], function () {
    Route::get('/', [MediaFolderController::class, 'index'])->name('index');
    Route::get('/create', [MediaFolderController::class, 'create'])->name('create')->middleware(['auth:sanctum', Admin::class]);
    Route::post('/store', [MediaFolderController::class, 'store'])->name('store')->middleware(['auth:sanctum', Admin::class]);
    Route::get('/{folder}/', [MediaFolderController::class, 'show'])->name('show');
    Route::get('/{folder}/edit', [MediaFolderController::class, 'edit'])->name('edit')->middleware(['auth:sanctum', Admin::class]);
    Route::post('/{folder}/update', [MediaFolderController::class, 'update'])->middleware(['auth:sanctum', Admin::class]);
    Route::delete('/{folder}', [MediaFolderController::class, 'destroy'])->name('destroy')->middleware(['auth:sanctum', Admin::class]);
});

Route::group([
    'as' => 'users.',
    'prefix' => 'users'
], function () {
    Route::get('/all', [UserController::class, 'index'])->name('index');
    Route::post('/search', [UserController::class, 'search'])->name('search')->middleware(['auth:sanctum', Admin::class]);
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit')->middleware(['auth:sanctum', Admin::class]);
    Route::put('/{user}', [UserController::class, 'update'])->name('update')->middleware(['auth:sanctum', Admin::class]);
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy')->middleware(['auth:sanctum', Admin::class]);
});


Route::group([
    'as' => 'headings.',
    'prefix' => 'headings',
], function () {
    Route::get('/names', [HeadingController::class, 'getNames']);
    Route::get('/', [HeadingController::class, 'index'])->name('index');
    Route::get('/create', [HeadingController::class, 'create'])->name('create')->middleware('auth:sanctum');
    Route::post('/store', [HeadingController::class, 'store'])->name('store')->middleware('auth:sanctum');
    Route::get('/{heading}/', [HeadingController::class, 'show'])->name('show');
    Route::get('/{heading}/edit', [HeadingController::class, 'edit'])->name('edit')->middleware('auth:sanctum');
    Route::post('/{heading}/update', [HeadingController::class, 'update'])->name('update')->middleware('auth:sanctum');
    Route::delete('/delete/{heading}', [HeadingController::class, 'destroy'])->name('destroy')->middleware('auth:sanctum');
});

Route::group([
    'as' => 'issues.',
    'prefix' => 'issues'
], function () {
    Route::get('/latest', [IssueController::class, 'lastFive'])->name('latest');
    Route::get('/', [IssueController::class, 'index'])->name('index');
    Route::get('/create', [IssueController::class, 'create'])->name('create')->middleware('auth:sanctum');
    Route::post('/store', [IssueController::class, 'store'])->name('store')->middleware('auth:sanctum');
    Route::post('/search', [IssueController::class, 'search'])->name('search');
    Route::get('/{issue}/', [IssueController::class, 'show'])->name('show');
    Route::get('/{issue}/edit', [IssueController::class, 'edit'])->name('edit')->middleware('auth:sanctum');
    Route::put('/{issue}', [IssueController::class, 'update'])->name('update')->middleware('auth:sanctum');
    Route::delete('/{id}', [IssueController::class, 'destroy'])->name('destroy')->middleware('auth:sanctum');
    Route::put('/recover/{id}', [IssueController::class, 'recover'])->name('recover')->middleware('auth:sanctum');
});

Route::group([
    'as' => 'archived.',
    'prefix' => 'archived'
], function () {
    Route::get('/issues', [IssueController::class, 'archive'])->name('issues.show')->middleware('auth:sanctum');
    Route::get('/states', [StateController::class, 'archive'])->name('states.show')->middleware('auth:sanctum');
});

Auth::routes();

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/home', [StartController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'verification'
], function () {
    Route::post('/', [EmailVerificationController::class, 'verify'])->name('verification');
    Route::post('/reset', [EmailVerificationController::class, 'reset'])->name('verification.reset');
    Route::post('/activate', [EmailVerificationController::class, 'activate'])->name('verification.activate');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/user', [AuthenticationController::class, 'user']);
});

Route::group([
    'as' => 'profiles.',
    'prefix' => 'profiles'
], function () {
    Route::get('/', [ProfileController::class, 'show'])->name('show')->middleware('auth');
    Route::get('{profile}/edit', [ProfileController::class, 'edit'])->name('edit')->middleware('auth');
    Route::put('/update', [ProfileController::class, 'update'])->name('update')->middleware('auth');
});
