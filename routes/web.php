<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('index');
Route::get('/contact-us', [WebController::class, 'contactUs'])->name('contactUs');
Route::get('submit-video', [WebController::class, 'submitVideo'])->name('submitVideo');
Route::get('blog', [WebController::class, 'blog'])->name('blog.index');
Route::get('blog/{blog}', [WebController::class, 'blogDetail'])
    ->name('blog.show');
Route::get('about-us', [WebController::class, 'aboutUs'])->name('aboutUs');

Route::get('videos', [WebController::class, 'videos'])->name('videos');
Route::get('videos/{video:youtube_id}', [WebController::class, 'showVideo'])->name('videos.show');

Route::get('movies', [WebController::class, 'movies'])->name('movies');
Route::get('movies/{movie:slug}', [WebController::class, 'showMovie'])->name('showMovie');












Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
