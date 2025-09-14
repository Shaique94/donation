<?php

use App\Livewire\Admin\Auth\Login;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',Login::class)->name('login');
