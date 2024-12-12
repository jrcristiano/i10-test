<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [
    ArticleController::class,
    'index'
])->name('welcome');

Route::middleware('auth')
    ->prefix('/categorias')
    ->group(function () {
        Route::get(
            '',
            [CategoryController::class, 'index']
        )->name('categories.index');

        Route::group(['middleware' => ['role:admin']], function () {
            Route::get(
                'criar',
                [CategoryController::class, 'create']
            )->name('categories.create');

            Route::post(
                '',
                [CategoryController::class, 'store']
            )->name('categories.store');

            Route::get(
                '{id}/editar',
                [CategoryController::class, 'edit']
            )->name('categories.edit');

            Route::put(
                '{id}',
                [CategoryController::class, 'update']
            )->name('categories.update');

            Route::delete(
                '{id}',
                [CategoryController::class, 'destroy']
            )->name('categories.destroy');
        });
    });

Route::middleware('auth')
    ->prefix('artigos')
    ->group(function () {
        Route::group(function () {
            Route::get('', [ArticleController::class, 'getPaginatedNews'])->name('articles.all');
        });

        Route::group(function () {
            Route::get('/meus-artigos', [ArticleController::class, 'getNewsListByUser'])->name('articles.my-articles');
        });

        Route::get(
            'novo', [ArticleController::class, 'create'])->name('articles.create');

        Route::post(
            '',
            [ArticleController::class, 'store']
        )->name('articles.store');

        Route::get(
            '/{id}/editar',
            [ArticleController::class, 'edit']
        )->name('articles.edit');

        Route::put(
            '/{id}',
            [ArticleController::class, 'update']
        )->name('articles.update');

        Route::delete(
            '/{id}',
            [ArticleController::class, 'destroy']
        )->name('articles.destroy');
    });

Route::get(
    '/noticias/{slug}',
    [ArticleController::class, 'show']
)->name('articles.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')
    ->prefix('/perfil')
    ->group(function () {
        Route::get(
            '',
            [ProfileController::class, 'edit']
        )->name('profile.edit');

        Route::patch(
            '',
            [ProfileController::class, 'update']
        )->name('profile.update');

        Route::delete(
            '',
            [ProfileController::class, 'destroy']
        )->name('profile.destroy');
    });

require __DIR__.'/auth.php';
