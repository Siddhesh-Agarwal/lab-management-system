<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LablistController;
use App\Http\Controllers\LabMoveController;
use App\Http\Controllers\OtherDeviceController;
use App\Http\Controllers\ScrapController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ConsumableController;
use App\Http\Controllers\TempController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::post('/forget_password', [AdminController::class, 'password']);

Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::post('/search', [AdminController::class, 'searchByLabSerial'])->name('admin.searchSerial');
    Route::post('/searchSystem', [AdminController::class, 'searchByLabSystem'])->name('admin.searchSystem');
    Route::post('/searchDevice', [AdminController::class, 'searchByLabDevice'])->name('admin.searchDevice');

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/forcelogout', [AdminController::class, 'forceLogout'])->name('admin.force');
    Route::get('/contact', [AdminController::class, 'contact'])->name('admin.contact');
    Route::get('/simple-search', [AdminController::class, 'simple_search'])->name('admin.searchlabs');
    Route::get('/advance-search', [AdminController::class, 'advance_search'])->name('admin.advance.search');
    Route::get('/device-details', [AdminController::class, 'device_details'])->name('admin.device.details');
    Route::get('/data-tables', [AdminController::class, 'tables'])->name('admin.tables');
    Route::get('/', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/', [AdminController::class, 'save_student'])->name('admin.student.add');
    Route::get('/show-students', [AdminController::class, 'show'])->name('admin.student.details');
    Route::get('addlabmovelist/{id}', [LabMoveController::class, 'adda']);
    Route::post('/save-labmove', [LabMoveController::class, 'save'])->name('labmove.store');
    Route::get('listdevice/{lab_name}', [LabController::class, 'index'])->name('admin.listdevice');
    Route::get('/admin/labdetails/{labname}', [LablistController::class, 'getLabDetails']);
    Route::get('/labs/{lab_name}', [LablistController::class, 'showDevices'])->name('lab.devices');
    Route::get('addlistdevice', [LabController::class, 'add'])->name('admin.adddevice');
    Route::get('editlistdevice/{id}', [LabController::class, 'edit']);
    Route::post('savelistdevice', [LabController::class, 'save']);
    Route::post('updatelistdevice', [LabController::class, 'update']);
    // Route::post('/labs/{id}/move', [LabController::class, 'moveToScraps'])->name('temps.moveDatas');
    Route::get('lablist/{lab_name}', [LablistController::class, 'indexa'])->name('admin.lablist');
    Route::get('addlablistdevice', [LablistController::class, 'adda']);
    Route::get('editlablistdevice/{id}', [LablistController::class, 'edita']);
    Route::post('savelablistdevice', [LablistController::class, 'savea']);
    Route::post('updatelablistdevice', [LablistController::class, 'updatea']);
    Route::get('otherdevice/{lab_name}', [OtherDeviceController::class, 'indexa'])->name('admin.otherdevice');
    Route::get('addotherdevice', [OtherDeviceController::class, 'adda']);
    Route::get('editotherdevice/{id}', [OtherDeviceController::class, 'edita']);
    Route::post('saveotherdevice', [OtherDeviceController::class, 'savea']);
    Route::post('updateotherdevice', [OtherDeviceController::class, 'updatea']);
    Route::post('/labs/movetotemp', [LabController::class, 'moveToScraps'])->name('temps.moveData');
    Route::post('/movetotemp/{id}', [LabController::class, 'movetotemp'])->name('temps.movecount');
    Route::get('consumables/{lab_name}', [ConsumableController::class, 'indexadmin'])->name('admin.consumables');
});

Route::prefix('superadmin')->middleware('superadmin.auth')->group(function () {
    Route::get('/getSystemNumbers/{lab}', [SuperAdminController::class, 'getSystemNumbers']);
    Route::get('/deleteAll',[ScrapController::class,'deleteAll']);
    Route::get('/addlab', [SuperAdminController::class, 'addlab'])->name('superadmin.addlabs');
    Route::post('/savelabs', [SuperAdminController::class, 'savelab'])->name('superadmin.savelabs');
    Route::get('/labdetails', [SuperAdminController::class, 'getLabDetails'])->name('superadmin.labdetails');
    Route::get('/searchlabs', [SuperAdminController::class, 'searchlab'])->name('superadmin.searchlabs');
    Route::post('/search', [SuperAdminController::class, 'searchBySerial'])->name('superadmin.searchSerial');
    Route::post('/searchSystem', [SuperAdminController::class, 'searchBySystem'])->name('superadmin.searchSystem');
    Route::post('/searchDevice', [SuperAdminController::class, 'searchByDevice'])->name('superadmin.searchDevice');
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
    Route::get('deletelablist/{id}', [LabController::class, 'delete']);
    Route::post('updatelistdevice', [LabController::class, 'updates']);
    Route::get('searchlabdevices', [LabController::class, 'searchlab'])->name('superadmin.searchlabdevices');
    Route::post('savelistdevice', [LabController::class, 'saves']);
    Route::get('savelablistdevices', [LabController::class, 'adds'])->name('superadmin.savelablistdevices');
    Route::get('addlablistdevices', [LabController::class, 'indexs'])->name('superadmin.lablistdevices');
    Route::get('editlablistdevices/{id}', [LabController::class, 'edits'])->name('superadmin.editlablistdevices');
    Route::get('searchlablistdevices', [LablistController::class, 'searchlab'])->name('superadmin.searchlablistdevices');
    Route::get('searchotherdevices', [OtherDeviceController::class, 'searchlab'])->name('superadmin.searchotherdevices');
    Route::get('labmovelist', [LabMoveController::class, 'index'])->name('superadmin.lablist');
    Route::get('list', [ScrapController::class, 'index'])->name('scrap.list');
    Route::get('addlist', [ScrapController::class, 'add']);
    Route::get('editlist/{id}', [ScrapController::class, 'edit']);
    Route::get('deletelist/{id}', [ScrapController::class, 'delete']);
    Route::post('savelist', [ScrapController::class, 'save']);
    Route::post('updatelist', [ScrapController::class, 'update']);
    Route::get('deletelistdevice/{id}', [LabController::class, 'delete']);
    Route::get('lablist', [LablistController::class, 'index'])->name('superadmin.lablists');
    Route::get('addlablistdevice', [LablistController::class, 'add']);
    Route::get('editlablistdevice/{id}', [LablistController::class, 'edit']);
    Route::post('savelablistdevice', [LablistController::class, 'save']);
    Route::post('updatelablistdevice', [LablistController::class, 'update']);
    Route::get('deletelablistdevice/{id}', [LablistController::class, 'delete']);
    Route::get('otherdevice', [OtherDeviceController::class, 'index'])->name('superadmin.otherdevice');
    Route::get('addotherdevice', [OtherDeviceController::class, 'add']);
    Route::get('editotherdevice/{id}', [OtherDeviceController::class, 'edit']);
    Route::post('saveotherdevice', [OtherDeviceController::class, 'save']);
    Route::post('updateotherdevice', [OtherDeviceController::class, 'update']);
    Route::get('deleteotherdevice/{id}', [OtherDeviceController::class, 'delete']);
    Route::get('listinglabs', [LablistController::class, 'listing_labs'])->name('superadmin.listinglabs');
    Route::get('editlistinglabs/{id}', [LablistController::class, 'edit_listing_labs']);
    Route::post('updatelistinglabs', [LablistController::class, 'update_listing_labs']);
    Route::get('consumables', [ConsumableController::class, 'index'])->name('superadmin.list.consumables');
    Route::get('consumables/edit/{id}', [ConsumableController::class, 'edit'])->name('superadmin.list.consumablesedit');
    Route::post('consumables/update', [ConsumableController::class, 'update'])->name('superadmin.list.consumablesupdate');
    Route::get('consumables/add', [ConsumableController::class, 'add'])->name('superadmin.list.consumablesadd');
    Route::post('consumables/save', [ConsumableController::class, 'save'])->name('superadmin.list.consumablessave');
    Route::get('deletecosumables/{id}', [ConsumableController::class, 'delete']);
    Route::delete('deletelab/{id}', [LabController::class, 'delete_lab']);
});

Route::prefix('superadmin')->group(function () {
    Route::get('listtemps', [TempController::class, 'index'])->name('temp.list');
    Route::post('/temp/{id}/move', [TempController::class, 'moveToScraps'])->name('labs.moveData');
    Route::post('/lab/{id}/move', [LabMoveController::class, 'moveToSource'])->name('labs.moveSource');
    Route::post('/lab/{id}/destination', [LabMoveController::class, 'moveToDestination'])->name('labs.moveDestination');
    Route::post('/temp/{id}/moveback', [TempController::class, 'moveToBack'])->name('labs.moveBack');
});

Auth::routes();

Route::get('/error', [HomeController::class, 'error'])->name('error');
