<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/contact', [AdminController::class, 'contact'])->name('admin.contact');
    Route::get('/simple-search', [AdminController::class, 'simple_search'])->name('admin.search');
    Route::get('/advance-search', [AdminController::class, 'advance_search'])->name('admin.advance.search');
    Route::get('/add-device', [AdminController::class, 'add_device'])->name('admin.add.device');
    Route::get('/data-tables', [AdminController::class, 'tables'])->name('admin.tables');
    Route::get('/', [AdminController::class, 'logout'])->name('admin.logout');
});

Route::prefix('superadmin')->middleware('superadmin.auth')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/contact', [SuperAdminController::class, 'contact'])->name('superadmin.contact');
    Route::get('/simple-search', [SuperAdminController::class, 'simple_search'])->name('superadmin.search');
    Route::get('/advance-search', [SuperAdminController::class, 'advance_search'])->name('superadmin.advance.search');
    Route::get('/data-tables', [SuperAdminController::class, 'tables'])->name('superadmin.tables');
    Route::get('/', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
});

Auth::routes();

Route::get('/error', [HomeController::class, 'error'])->name('error');

