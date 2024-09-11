<?php

use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Blog resource routes
    Route::resource('dashboard/blogs', BlogController::class)->names([
        'index' => 'dashboard.blogs.index',
        'create' => 'dashboard.blogs.create',
        'store' => 'dashboard.blogs.store',
        'show' => 'dashboard.blogs.show',
        'edit' => 'dashboard.blogs.edit',
        'update' => 'dashboard.blogs.update',
        'destroy' => 'dashboard.blogs.destroy',
    ])->parameters([
        'blogs' => 'slug'
    ]);

    // Project resource routes
    Route::resource('dashboard/projects', ProjectController::class)->names([
        'index' => 'dashboard.projects.index',
        'create' => 'dashboard.projects.create',
        'store' => 'dashboard.projects.store',
        'show' => 'dashboard.projects.show',
        'edit' => 'dashboard.projects.edit',
        'update' => 'dashboard.projects.update',
        'destroy' => 'dashboard.projects.destroy',
    ])->parameters([
        'projects' => 'slug'
    ]);
});

require __DIR__.'/auth.php';
