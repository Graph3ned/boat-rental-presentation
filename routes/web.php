<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::view('/', 'welcome');
Route::get('/', function () {
    return redirect()->route('login');
});

Route::view('/staff/dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'staff'])
    ->name('dashboard');

Route::view('/staff/create', 'create')
    ->middleware(['auth', 'verified', 'staff'])
    ->name('create');

Route::view('/staff/{rideId}/edit', 'edit')
    ->middleware(['auth', 'verified', 'staff'])
    ->name('edit-ride');

Route::view('/admin/sales', 'sales')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('sales');

Route::view('/admin/prices', 'AdminDashboard')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('AdminDashboard');

Route::view('/admin/create', 'AddWaterRide')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('AddWaterRide');

Route::view('/admin/editRide/{ride_type}', 'AdminEdit')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('AdminEdit');

Route::view('/admin/{id}/sales-edit', 'sales-edit')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('sales-edit');

Route::view('/admin/staffs', 'staffs')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('staffs');

Route::view('/admin/updateStaff/{staffId}', 'updateStaff')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('updateStaff');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Volt::route('/admin/staff-register', 'pages.auth.register')
            ->name('register');    
    });

Route::view('/admin/price/{ride_type}', 'priceClassification')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('priceClassification');

Route::view('/admin/addPriceClassification/{ride_type}', 'addPriceClassification')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('addPriceClassification');

Route::view('/admin/priceEdit/{id}', 'priceEdit')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('priceEdit');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('/admin/staff-edit/{id}', 'staffEdit')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('staffEdit');
require __DIR__.'/auth.php';
