<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect('/login');
});

// Route Auth - bisa diakses tanpa login
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Todo - hanya bisa diakses kalau sudah login
Route::middleware('auth')->group(function() {
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todos/{id}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
    Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
});