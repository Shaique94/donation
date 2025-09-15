<?php

use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Plan\Create;
use App\Livewire\Admin\Plan\Edit;
use App\Livewire\Admin\Plan\Index;
use App\Livewire\Admin\Users\Add;
use App\Livewire\Admin\Users\Edit as UsersEdit;
use App\Livewire\Admin\Users\Index as UsersIndex;
use App\Livewire\Admin\Donations;
use App\Livewire\Admin\Expenses;
use App\Livewire\Admin\Reports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',Login::class)->name('login');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard',Dashboard::class)->name('admin.dashboard');
    
    // Plan routes
    Route::get('/admin/create/plans',Create::class)->name('admin.plan.create');
    Route::get('/admin/plans',Index::class)->name('admin.plan.index');
    Route::get('/admin/edit/plan/{planId}',Edit::class)->name('admin.plan.edit');

    // User routes
    Route::get('/admin/add-user', Add::class)->name('admin.users.add');
    Route::get('/admin/users', UsersIndex::class)->name('admin.users');
    Route::get('/admin/edit/user/{user}', UsersEdit::class)->name('admin.edit.user');
    
    // Donation routes
    Route::get('/admin/donations', Donations::class)->name('admin.donations');
    Route::get('/admin/donations/create', Donations::class)->name('admin.donations.create');
    
    // Expense routes
    Route::get('/admin/expenses', Expenses::class)->name('admin.expenses');
    Route::get('/admin/expenses/create', Expenses::class)->name('admin.expenses.create');
    
    // Reports route
    Route::get('/admin/reports', Reports::class)->name('admin.reports');

    Route::post('/logout', function () {
        Auth::logout();
    
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    
        return redirect('/');
    })->name('logout');
});