<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rota inicial
Route::get('/', function () {
    return view('welcome');
});

// Rota para início com middlewares aplicados
Route::get('/inicio', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// Grupo de rotas protegidas para perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grupo de rotas para categorias com middlewares
Route::middleware(['auth', 'verified'])->prefix('categorias')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('nova', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('{id}/editar', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Grupo de rotas para artigos com middlewares e prefixo
Route::middleware('auth')->prefix('artigos')->group(function () {
    Route::get('', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('meus-artigos', [ArticleController::class, 'getPaginatedArticleListByUserId'])->name('articles.my-articles');
    Route::get('novo', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('{id}/editar', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// Rota pública para exibição de artigos
Route::get('/noticias/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Arquivo adicional de rotas de autenticação
require __DIR__.'/auth.php';
