<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/{any}', [AppController::class, 'index'])->where('any', '.*')->name('app.index');

Route::get('/dashboard', function ()
{
   return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
