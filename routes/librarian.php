<?php

use App\Http\Controllers\Librarian\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Librarian\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Librarian\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Librarian\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Librarian\Auth\NewPasswordController;
use App\Http\Controllers\Librarian\Auth\PasswordController;
use App\Http\Controllers\Librarian\Auth\PasswordResetLinkController;
use App\Http\Controllers\Librarian\Auth\RegisteredUserController;
use App\Http\Controllers\Librarian\Auth\VerifyEmailController;
use App\Http\Controllers\Librarian\BooksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Librarian\GenreController;
use App\Http\Controllers\Librarian\LibrarianController;
use App\Models\Book;

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

Route::middleware('auth:librarian')->group(function () {
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

Route::get('/dashboard', [LibrarianController::class, 'dashboard'])
    ->middleware(['auth:librarian', 'verified'])->name('dashboard');

Route::middleware('auth:librarian')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('genres', GenreController::class)->middleware('auth:librarian');

Route::resource('books', BooksController::class)->middleware('auth:librarian');

Route::prefix('deleted-genre')
->middleware('auth:librarian')
->group(function(){
    Route::get('/index', [GenreController::class, 'deletedGenreIndex'])->name('deleted-genre.index');
    Route::post('/destroy/{genre}', [GenreController::class, 'deletedGenreDestroy'])->name('deleted-genre.destroy');
    Route::post('/restore/{genre}', [GenreController::class, 'deletedGenreRestore'])->name('deleted-genre.restore');
});

Route::prefix('deleted-book')
->middleware('auth:librarian')
->group(function(){
    Route::get('/index', [BooksController::class, 'deletedBookIndex'])->name('deleted-book.index');
    Route::post('/destroy/{book}', [BooksController::class, 'deletedBookDestroy'])->name('deleted-book.destroy');
    Route::post('/restore/{book}', [BooksController::class, 'deletedBookRestore'])->name('deleted-book.restore');
});

Route::prefix('books')
->middleware('auth:librarian')
->group(function(){
    Route::get('/filteredByGenre/{genre}', [BooksController::class, 'filteredByGenre'])->name('books.filtered-by-genre');
    Route::get('/filteredByTitle/{keyword}', [BooksController::class, 'filteredByTitle'])->name('books.filtered-by-title');
    Route::get('/filteredByAuthors/{keyword}', [BooksController::class, 'filteredByAuthors'])->name('books.filtered-by-authors');
});