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
    Route::get('/admin-add', [SuperAdminController::class, 'add_admin'])->name('superadmin.add');
    Route::post('/', [SuperAdminController::class, 'create'])->name('superadmin.add.admin');
    Route::delete('/{id}', [SuperAdminController::class, 'delete_admin'])->name('superadmin.delete.admin');
    Route::get('/edit/{id}', [SuperAdminController::class, 'edit_admin'])->name('superadmin.edit.admin');
    Route::patch('/{id}', [SuperAdminController::class, 'update_admin'])->name('superadmin.update.admin');
    Route::get('/admin-details', [SuperAdminController::class, 'details'])->name('superadmin.details');
    Route::get('/', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
});

Auth::routes();

Route::get('/error', [HomeController::class, 'error'])->name('error');

