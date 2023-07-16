<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\Auth\LoginController;
// Frontend
use App\Http\Controllers\Frontend\IndexController;
// Backend
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\TestimoniController;
use App\Http\Controllers\Backend\HistoryController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\MaterialController;
use App\Http\Controllers\Backend\TypesController;


Route::prefix('auth')->middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function() {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'postlogin')->name('post.login');
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/', function() {
        return redirect()->route('login');
    });


    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::controller(DashboardController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('admin.dashboard');
            Route::get('/read-all-notif','read_all_notif')->name('admin.notif.readall');
            Route::get('/read-notif/{id}','read_notif')->name('admin.notif.read');
            Route::get('/transaction', 'scan_qr')->name('admin.qr.scan');
            Route::prefix('transaction')->group(function() {
                Route::get('/barcode/download/{id}', 'download_barcode')->name('admin.qr.download');
                Route::get('/total-progress', 'total_progress');
                Route::get('/total-done', 'total_done');
            });

        });

        // User Management
        Route::prefix('users')->controller(UserController::class)->group(function() {
            Route::get('/', 'index')->name('admin.user.index');
            Route::get('/create', 'create')->name('admin.user.create');
            Route::post('/store', 'store')->name('admin.user.store');
            Route::get('/edit/{id}', 'edit')->name('admin.user.edit');
            Route::post('/update/{id}', 'update')->name('admin.user.update');
            Route::post('/destory/{id}', 'destroy')->name('admin.user.destroy');
        });

        // Roles Management
        Route::prefix('roles')->controller(RolesController::class)->group(function() {
            Route::get('/', 'index')->name('admin.roles.index');
            Route::get('/edit/{id}', 'edit')->name('admin.roles.edit');
            Route::post('/update/{id}', 'update')->name('admin.roles.update');
        });


        // Order Management
        Route::prefix('orders')->controller(OrderController::class)->group(function() {
            Route::get('/', 'index')->name('admin.order.index');
            Route::get('/detail/{id}', 'detail')->name('admin.order.detail');
            Route::get('/create', 'create')->name('admin.order.create');
            Route::post('/store', 'store')->name('admin.order.store');
            Route::get('/edit/{id}', 'edit')->name('admin.order.edit');
            Route::post('/update/{id}', 'update')->name('admin.order.update');
            Route::post('/update-status/{id}', 'approval')->name('admin.order.updatestatus');
            Route::post('/taken-order/{id}', 'order_taken')->name('admin.order.taken');
            Route::get('/travel-document/{id}', 'travel_document')->name('admin.order.traveldocument');
            Route::get('/invoice/{invoice}', 'invoice')->name('admin.order.invoice');
            Route::post('/payment/{id}', 'payment')->name('admin.order.payment');
        });

        // Material Management
        Route::prefix('material')->controller(MaterialController::class)->group(function() {
            Route::get('/', 'index')->name('admin.material.index');
            Route::get('/create', 'create')->name('admin.material.create');
            Route::post('/store', 'store')->name('admin.material.store');
            Route::get('/edit/{id}', 'edit')->name('admin.material.edit');
            Route::post('/update/{id}', 'update')->name('admin.material.update');
            Route::post('/destory/{id}', 'destroy')->name('admin.material.destroy');
            Route::get('/get-material', 'get_material')->name('admin.material.get');
        });

        // Types Management
        Route::prefix('types')->controller(TypesController::class)->group(function() {
            Route::get('/', 'index')->name('admin.types.index');
            Route::get('/create', 'create')->name('admin.types.create');
            Route::post('/store', 'store')->name('admin.types.store');
            Route::get('/edit/{id}', 'edit')->name('admin.types.edit');
            Route::post('/update/{id}', 'update')->name('admin.types.update');
            Route::post('/destory/{id}', 'destroy')->name('admin.types.destroy');
        });

        // Project Management
        Route::prefix('project')->controller(ProjectController::class)->group(function() {
            Route::get('/', 'index')->name('admin.project.index');
            Route::get('/detail/{id}', 'detail')->name('admin.project.detail');
            Route::get('/create', 'create')->name('admin.project.create');
            Route::post('/store', 'store')->name('admin.project.store');
            Route::get('/edit/{id}', 'edit')->name('admin.project.edit');
            Route::post('/update/{id}', 'update')->name('admin.project.update');
            Route::post('/destory/{id}', 'destroy')->name('admin.project.destroy');
        });

        // Tertimoni Management
        Route::prefix('testimonial')->controller(TestimoniController::class)->group(function() {
            Route::get('/', 'index')->name('admin.testimoni.index');
            Route::get('/detail/{id}', 'detail')->name('admin.testimoni.detail');
            Route::get('/create', 'create')->name('admin.testimoni.create');
            Route::post('/store', 'store')->name('admin.testimoni.store');
            Route::get('/edit/{id}', 'edit')->name('admin.testimoni.edit');
            Route::post('/update/{id}', 'update')->name('admin.testimoni.update');
            Route::post('/destory/{id}', 'destroy')->name('admin.testimoni.destroy');
        });

        // History Management
        Route::prefix('history')->controller(HistoryController::class)->group(function() {
            Route::get('/', 'index')->name('admin.history.index');
        });

    });
});

// Frontend 
Route::middleware('web')->group(function () {
    Route::controller(IndexController::class)->group(function() {
        Route::get('/', 'home')->name('home');
    });
});
