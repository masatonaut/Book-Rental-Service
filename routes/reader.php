<?php

use App\Http\Controllers\Reader\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Reader\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Reader\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Reader\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Reader\Auth\NewPasswordController;
use App\Http\Controllers\Reader\Auth\PasswordController;
use App\Http\Controllers\Reader\Auth\PasswordResetLinkController;
use App\Http\Controllers\Reader\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reader\BooksController;
use App\Http\Controllers\Reader\ReaderController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth:reader')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});



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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ReaderController::class, 'dashboard'])
    ->middleware(['auth:reader', 'verified'])->name('dashboard');

Route::middleware('auth:reader')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('books')
    ->middleware('auth:reader')
    ->group(function () {
        Route::get('/filteredByGenre/{genre}', [BooksController::class, 'filteredByGenre'])->name('books.filtered-by-genre');
        Route::get('/filteredByTitle/{keyword}', [BooksController::class, 'filteredByTitle'])->name('books.filtered-by-title');
        Route::get('/filteredByAuthors/{keyword}', [BooksController::class, 'filteredByAuthors'])->name('books.filtered-by-authors');
        Route::get('/show/{book}', [BooksController::class, 'show'])->name('books.show');
    });
