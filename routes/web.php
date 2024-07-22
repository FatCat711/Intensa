<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadCreateController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [FeedController::class, 'feed'])->name('feed');

Route::get('/create', [LeadController::class, 'show'])->name('show');

Route::post('/created', [LeadCreateController::class, 'create'])->name('create');
