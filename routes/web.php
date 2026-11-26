<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/layanan', [PageController::class, 'services'])->name('services');
Route::get('/layanan/{slug}', [PageController::class, 'product'])->name('services.show');
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
