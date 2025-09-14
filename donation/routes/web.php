<?php

use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Plan\Index;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',Login::class)->name('login');

Route::get('/admin/dashboard',Dashboard::class)->name('admin.dashboard');
Route::get('/plans',Index::class)->name('admin.plan.index');