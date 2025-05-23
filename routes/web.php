<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Student\Slots\Browse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'))->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')
         ->middleware('verified')
         ->name('dashboard');

    Route::view('/profile', 'profile')
         ->name('profile');

    Route::get('/reservar', fn() => view('student.slots.browse'))
         ->name('student.slots');
         
    Route::get('/student/slots', Browse::class)
     ->middleware('auth')
     ->name('student.slots.browse');
});

require __DIR__.'/auth.php';
