<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrapingController;

Route::get('/scrape', [ScrapingController::class, 'scrape'])->name('scrape');
Route::get('/produtos', [ScrapingController::class, 'index'])->name('produtos.index');

