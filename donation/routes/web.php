<?php

use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Plan\Create;
use App\Livewire\Admin\Plan\Edit;
use App\Livewire\Admin\Plan\Index;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',Login::class)->name('login');

Route::get('/admin/dashboard',Dashboard::class)->name('admin.dashboard');
Route::get('/admin/create/plans',Create::class)->name('admin.plan.create');
Route::get('/admin/plans',Index::class)->name('admin.plan.index');
Route::get('/admin/edit/plan/{planId}',Edit::class)->name('admin.plan.edit');