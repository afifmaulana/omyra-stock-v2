<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FinishController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SemifinishController;
use App\Http\Controllers\Admin\StockInnerController;
use App\Http\Controllers\Admin\StockMasterController;
use App\Http\Controllers\Admin\StockPlasticController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\DashboardController as FrontendDashboardController;
use App\Http\Controllers\Frontend\FinishController as FrontendFinishController;
use App\Http\Controllers\Frontend\InnerController;
use App\Http\Controllers\Frontend\MasterController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\PlasticController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ReportPlasticController;
use App\Http\Controllers\Frontend\SemiFinishController as FrontendSemiFinishController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/login/logout', [LoginController::class, 'logout'])->name('logout.submit');

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {
    Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::prefix('user')->group(function () {
        Route::get('index', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('store', [UserController::class, 'store'])->name('admin.user.store');
    });
    Route::prefix('brand')->group(function () {
        Route::get('index', [BrandController::class, 'index'])->name('admin.brand.index');
        Route::get('create', [BrandController::class, 'create'])->name('admin.brand.create');
        Route::post('store', [BrandController::class, 'store'])->name('admin.brand.store');
        Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
        Route::put('edit/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
        Route::delete('{id}', [BrandController::class, 'destroy'])->name('admin.brand.delete');
    });
    Route::prefix('product')->group(function () {
        Route::get('index', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('edit/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');
    });
    Route::prefix('material')->group(function () {
        Route::get('index', [MaterialController::class, 'index'])->name('admin.material.index');
        Route::get('create', [MaterialController::class, 'create'])->name('admin.material.create');
        Route::post('store', [MaterialController::class, 'store'])->name('admin.material.store');
        Route::get('edit/{id}', [MaterialController::class, 'edit'])->name('admin.material.edit');
        Route::put('edit/{id}', [MaterialController::class, 'update'])->name('admin.material.update');
        Route::delete('{id}', [MaterialController::class, 'destroy'])->name('admin.material.delete');
    });
    Route::prefix('stock')->group(function () {
        Route::prefix('plastic')->group(function () {
            Route::get('index', [StockPlasticController::class, 'index'])->name('admin.stock.plastic.index');
            Route::get('create', [StockPlasticController::class, 'create'])->name('admin.stock.plastic.create');
            Route::post('store', [StockPlasticController::class, 'store'])->name('admin.stock.plastic.store');
        });
        Route::prefix('inner')->group(function () {
            Route::get('index', [StockInnerController::class, 'index'])->name('admin.stock.inner.index');
            Route::get('create', [StockInnerController::class, 'create'])->name('admin.stock.inner.create');
            Route::post('store', [StockInnerController::class, 'store'])->name('admin.stock.inner.store');
        });
        Route::prefix('master')->group(function () {
            Route::get('index', [StockMasterController::class, 'index'])->name('admin.stock.master.index');
            Route::get('create', [StockMasterController::class, 'create'])->name('admin.stock.master.create');
            Route::post('store', [StockMasterController::class, 'store'])->name('admin.stock.master.store');
        });
    });
    Route::prefix('semifinish')->group(function () {
        Route::get('index', [SemifinishController::class, 'index'])->name('admin.semifinish.index');
        Route::get('create', [SemifinishController::class, 'create'])->name('admin.semifinish.create');
        Route::post('store', [SemifinishController::class, 'store'])->name('admin.semifinish.store');
    });
    Route::prefix('finish')->group(function () {
        Route::get('index', [FinishController::class, 'index'])->name('admin.finish.index');
        Route::get('create', [FinishController::class, 'create'])->name('admin.finish.create');
        Route::post('store', [FinishController::class, 'store'])->name('admin.finish.store');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [FrontendDashboardController::class, 'index'])->name('frontend.dashboard.index');
    Route::get('/notification', [NotificationController::class, 'index'])->name('frontend.notification.index');

    Route::prefix('stock')->group(function () {
        Route::prefix('plastic')->group(function () {
            Route::get('index', [PlasticController::class, 'index'])->name('frontend.plastic.index');
            Route::get('create', [PlasticController::class, 'create'])->name('frontend.plastic.create');
            Route::post('create', [PlasticController::class, 'store'])->name('frontend.plastic.store');
            Route::delete('{id}', [PlasticController::class, 'destroy'])->name('frontend.plastic.delete');
        });
        Route::prefix('inner')->group(function () {
            Route::get('index', [InnerController::class, 'index'])->name('frontend.inner.index');
            Route::get('create', [InnerController::class, 'create'])->name('frontend.inner.create');
            Route::post('create', [InnerController::class, 'store'])->name('frontend.inner.store');
            Route::delete('{id}', [InnerController::class, 'destroy'])->name('frontend.inner.delete');
        });
        Route::prefix('master')->group(function () {
            Route::get('index', [MasterController::class, 'index'])->name('frontend.master.index');
            Route::get('create', [MasterController::class, 'create'])->name('frontend.master.create');
            Route::post('create', [MasterController::class, 'store'])->name('frontend.master.store');
            Route::delete('{id}', [MasterController::class, 'destroy'])->name('frontend.master.delete');
        });
    });
    Route::prefix('profile')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('frontend.profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('frontend.profile.update');
    });

    Route::prefix('semi-finish')->group(function () {
        Route::get('index', [FrontendSemiFinishController::class, 'index'])->name('frontend.semi-finish.index');
        Route::get('create', [FrontendSemiFinishController::class, 'create'])->name('frontend.semi-finish.create');
        Route::post('store', [FrontendSemiFinishController::class, 'store'])->name('frontend.semi-finish.store');
        Route::delete('{id}', [FrontendSemiFinishController::class, 'destroy'])->name('frontend.semi-finish.delete');
    });
    Route::prefix('finish')->group(function () {
        Route::get('index', [FrontendFinishController::class, 'index'])->name('frontend.finish.index');
        Route::get('create', [FrontendFinishController::class, 'create'])->name('frontend.finish.create');
        Route::post('store', [FrontendFinishController::class, 'store'])->name('frontend.finish.store');
        Route::delete('{id}', [FrontendFinishController::class, 'destroy'])->name('frontend.finish.delete');
    });

    Route::prefix('report')->group(function () {
        Route::get('/plastic', [ReportPlasticController::class, 'index'])->name('frontend.report.plastic.index');
        Route::post('/plastic/data', [ReportPlasticController::class, 'data'])->name('frontend.report.plastic.data');
    });
});

require __DIR__ . '/auth.php';
