<?php

use App\Http\Controllers\Uploader;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Wel]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [Uploader::class, 'index'])->name('dashboard');
    Route::get('getfiliere/{id}', [Uploader::class, 'getfiliere']);
    Route::get('getmatiere/{id}', [Uploader::class, 'getmatiere']);
    Route::post('/dashboard', [Uploader::class, 'index'])->name('upload');
});



