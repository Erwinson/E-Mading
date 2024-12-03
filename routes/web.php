<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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


//View landing oage
Route::get('/', function () {
    return view('landingPage');
});

//like
Route::post('/artworks/{id}/like', [StudentController::class, 'like'])->name('artworks.like');
Route::get('/artworks/mostliked', [StudentController::class, 'getMostLiked'])->name('artworks.mostliked');

//comment
Route::get('/artworks/{artwork}/comments', [StudentController::class, 'showComments']);
Route::post('/artworks/{artwork}/comments', [StudentController::class, 'storeComment']);

//View Admin
Route::get('/create_news', [AdminController::class, 'createNews'])->name('admin.create');
Route::post('/create_news', [AdminController::class, 'store'])->name('createNews');



//View Student

Route::get('/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/create', [StudentController::class, 'store'])->name('create');
Route::put('/artwork/{id}', [StudentController::class, 'update'])->name('artwork.update');
Route::delete('/artwork/{id}', [StudentController::class, 'destroy'])->name('artwork.destroy');
Route::post('/artworks/{id}/repost', [StudentController::class, 'repost'])->name('artwork.repost');


Route::get('/home', [StudentController::class, 'index'])->name('home');
Route::get('/news', [StudentController::class, 'news'])->name('student.news');
Route::get('/videos', [StudentController::class, 'videos'])->name('student.videos');
Route::get('/poetrys', [StudentController::class, 'poetrys'])->name('student.poetrys');
Route::get('/posters', [StudentController::class, 'posters'])->name('student.posters');
Route::get('/history', [StudentController::class, 'history'])->name('student.history');
Route::get('/reposted-artworks', [StudentController::class, 'repostedArtworks'])->name('artwork.reposted');


//Auth
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});
