<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

Route::middleware('auth:api')->get('/user', function (Request $request)
{
   return $request->user();
});

Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store');
