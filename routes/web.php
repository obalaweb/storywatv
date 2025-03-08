<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('index');
Route::get('/contact-us', [WebController::class, 'contactUs'])->name('contactUs');
Route::get('submit-video', [WebController::class, 'submitVideo'])->name('submitVideo');

Route::get('about-us', [WebController::class, 'aboutUs'])->name('aboutUs');

Route::get('videos', [VideoController::class, 'index'])->name('videos');
Route::get('videos/{video:youtube_id}', [VideoController::class, 'show'])->name('videos.show');

Route::get('movies', [WebController::class, 'movies'])->name('movies');
Route::get('movies/{movie:slug}', [WebController::class, 'showMovie'])->name('showMovie');

Route::
    prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

        Route::get('/author/{slug}', [BlogController::class, 'author'])->name('blog.author');
        Route::get('/tag/{slug}', [BlogController::class, 'tag'])->name('blog.tag');
        Route::get('/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
    });


Route::get('play-next', [WebController::class, 'playNext'])->name('PlayNext');










Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
