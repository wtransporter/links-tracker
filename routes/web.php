<?php

use App\Http\Controllers\LinkController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::redirect('/', '/dashboard');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    // Route::inertia('/links', 'Links')->name('links');
    Route::get('/links', [LinkController::class, 'index'])->name('links');
    Route::post('/links', [LinkController::class, 'store'])->name('links.store');
    Route::put('/links/{link}', [LinkController::class, 'update'])->name('links.update');
    Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
});
