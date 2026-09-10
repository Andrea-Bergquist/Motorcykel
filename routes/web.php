<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsletterSubscriberController;
use App\Http\Controllers\ContactController;


Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/post/{id}', [PostController::class, 'show'])->name('show');

Route::post('/newsletter/subscribe', [PostController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/send-mail', [PostController::class, 'sendMail']);

Route::post('/kontakt', [ContactController::class, 'send'])
    ->name('contact.send');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/newsletter', [NewsletterSubscriberController::class, 'index'])
        ->name('admin.newsletter.index');
    Route::delete('/admin/newsletter/{subscriber}', [NewsletterSubscriberController::class, 'destroy'])
        ->name('admin.newsletter.destroy');

    Route::resource('admin', AdminController::class)->parameters([
        'admin' => 'post'
    ]);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
