<?php

use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Plan\Create;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',Login::class)->name('login');

Route::get('/admin/dashboard',Dashboard::class)->name('admin.dashboard');
Route::get('/admin/create/plans',Create::class)->name('admin.plan.create');