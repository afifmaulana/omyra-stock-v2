<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FinishController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReminderController;
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
use App\Http\Controllers\Frontend\RecordController;
use App\Http\Controllers\Frontend\RejectController;
use App\Http\Controllers\Frontend\RejectInnerController;
use App\Http\Controllers\Frontend\RejectMasterController;
use App\Http\Controllers\Frontend\RejectPlasticController;
use App\Http\Controllers\Frontend\ReportBrandController;
use App\Http\Controllers\Frontend\ReportFinishController;
use App\Http\Controllers\Frontend\ReportInnerController;
use App\Http\Controllers\Frontend\ReportMasterController;
use App\Http\Controllers\Frontend\ReportMaterialController;
use App\Http\Controllers\Frontend\ReportPlasticController;
use App\Http\Controllers\Frontend\ReportProductController;
use App\Http\Controllers\Frontend\ReportReminderController;
use App\Http\Controllers\Frontend\ReportSemifinishController;
use App\Http\Controllers\Frontend\ReportUserController;
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
    Route::prefix('reminder')->group(function () {
        Route::get('index', [ReminderController::class, 'index'])->name('admin.reminder.index');
        Route::get('create', [ReminderController::class, 'create'])->name('admin.reminder.create');
        Route::post('store', [ReminderController::class, 'store'])->name('admin.reminder.store');
        Route::get('edit/{id}', [ReminderController::class, 'edit'])->name('admin.reminder.edit');
        Route::put('edit/{id}', [ReminderController::class, 'update'])->name('admin.reminder.update');
        Route::delete('{id}', [ReminderController::class, 'destroy'])->name('admin.reminder.delete');
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
    Route::get('/ceo', [FrontendDashboardController::class, 'indexCeo'])->name('frontend.dashboard.ceo');
    Route::get('/notification', [NotificationController::class, 'index'])->name('frontend.notification.index');


    Route::prefix('stock')->group(function () {
        Route::prefix('plastic')->group(function () {
            Route::get('index', [PlasticController::class, 'index'])->name('frontend.plastic.index');
            Route::get('create', [PlasticController::class, 'create'])->name('frontend.plastic.create');
            Route::post('create', [PlasticController::class, 'store'])->name('frontend.plastic.store');
            Route::get('edit/{id}', [PlasticController::class, 'edit'])->name('frontend.plastic.edit');
            Route::put('edit/{id}', [PlasticController::class, 'update'])->name('frontend.plastic.update');
            Route::get('detail/{id}', [PlasticController::class, 'detail'])->name('frontend.plastic.detail');
            Route::delete('{id}', [PlasticController::class, 'destroy'])->name('frontend.plastic.delete');
        });
        Route::prefix('inner')->group(function () {
            Route::get('index', [InnerController::class, 'index'])->name('frontend.inner.index');
            Route::get('create', [InnerController::class, 'create'])->name('frontend.inner.create');
            Route::post('create', [InnerController::class, 'store'])->name('frontend.inner.store');
            Route::get('edit/{id}', [InnerController::class, 'edit'])->name('frontend.inner.edit');
            Route::put('edit/{id}', [InnerController::class, 'update'])->name('frontend.inner.update');
            Route::delete('{id}', [InnerController::class, 'destroy'])->name('frontend.inner.delete');
        });
        Route::prefix('master')->group(function () {
            Route::get('index', [MasterController::class, 'index'])->name('frontend.master.index');
            Route::get('create', [MasterController::class, 'create'])->name('frontend.master.create');
            Route::post('create', [MasterController::class, 'store'])->name('frontend.master.store');
            Route::get('edit/{id}', [MasterController::class, 'edit'])->name('frontend.master.edit');
            Route::put('edit/{id}', [MasterController::class, 'update'])->name('frontend.master.update');
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
        Route::get('edit/{id}', [FrontendSemiFinishController::class, 'edit'])->name('frontend.semi-finish.edit');
        Route::put('edit/{id}', [FrontendSemiFinishController::class, 'update'])->name('frontend.semi-finish.update');
        Route::delete('{id}', [FrontendSemiFinishController::class, 'destroy'])->name('frontend.semi-finish.delete');
    });
    Route::prefix('finish')->group(function () {
        Route::get('index', [FrontendFinishController::class, 'index'])->name('frontend.finish.index');
        Route::get('create', [FrontendFinishController::class, 'create'])->name('frontend.finish.create');
        Route::post('store', [FrontendFinishController::class, 'store'])->name('frontend.finish.store');
        Route::get('edit/{id}', [FrontendFinishController::class, 'edit'])->name('frontend.finish.edit');
        Route::put('edit/{id}', [FrontendFinishController::class, 'update'])->name('frontend.finish.update');
        Route::delete('{id}', [FrontendFinishController::class, 'destroy'])->name('frontend.finish.delete');
    });

    Route::prefix('report')->group(function () {
        Route::get('/plastic', [ReportPlasticController::class, 'index'])->name('frontend.report.plastic.index');
        Route::post('/plastic/data', [ReportPlasticController::class, 'data'])->name('frontend.report.plastic.data');
        Route::get('/plastic/detail/{id}', [ReportPlasticController::class, 'detail'])->name('frontend.report.plastic.detail');

        Route::get('/inner', [ReportInnerController::class, 'index'])->name('frontend.report.inner.index');
        Route::post('/inner/data', [ReportInnerController::class, 'data'])->name('frontend.report.inner.data');

        Route::get('/master', [ReportMasterController::class, 'index'])->name('frontend.report.master.index');
        Route::post('/master/data', [ReportMasterController::class, 'data'])->name('frontend.report.master.data');

        Route::get('/semifinish', [ReportSemifinishController::class, 'index'])->name('frontend.report.semifinish.index');
        Route::post('/semifinish/data', [ReportSemifinishController::class, 'data'])->name('frontend.report.semifinish.data');

        Route::get('/finish', [ReportFinishController::class, 'index'])->name('frontend.report.finish.index');
        Route::post('/finish/data', [ReportFinishController::class, 'data'])->name('frontend.report.finish.data');

        Route::get('/brand', [ReportBrandController::class, 'index'])->name('frontend.report.brand.index');


        Route::get('/product', [ReportProductController::class, 'index'])->name('frontend.report.product.index');


        Route::get('/material', [ReportMaterialController::class, 'index'])->name('frontend.report.material.index');


        Route::get('/user', [ReportUserController::class, 'index'])->name('frontend.report.user.index');


        Route::get('/reminder', [ReportReminderController::class, 'index'])->name('frontend.report.reminder.index');

        Route::prefix('reject')->group(function () {
            Route::prefix('plastic')->group(function () {
                Route::get('index', [RejectPlasticController::class, 'index'])->name('frontend.reject.plastic.index');
                Route::get('create', [RejectPlasticController::class, 'create'])->name('frontend.reject.plastic.create');
                Route::post('create', [RejectPlasticController::class, 'store'])->name('frontend.reject.plastic.store');
                Route::get('history/{materialId}', [RejectPlasticController::class, 'history'])->name('frontend.reject.plastic.history');
                Route::delete('{id}', [RejectPlasticController::class, 'destroy'])->name('frontend.reject.plastic.delete');
            });

            Route::prefix('inner')->group(function () {
                Route::get('index', [RejectInnerController::class, 'index'])->name('frontend.reject.inner.index');
                Route::get('create', [RejectInnerController::class, 'create'])->name('frontend.reject.inner.create');
                Route::post('create', [RejectInnerController::class, 'store'])->name('frontend.reject.inner.store');
                Route::delete('{id}', [RejectInnerController::class, 'destroy'])->name('frontend.reject.inner.delete');
            });

            Route::prefix('master')->group(function () {
                Route::get('index', [RejectMasterController::class, 'index'])->name('frontend.reject.master.index');
                Route::get('create', [RejectMasterController::class, 'create'])->name('frontend.reject.master.create');
                Route::post('create', [RejectMasterController::class, 'store'])->name('frontend.reject.master.store');
                Route::delete('{id}', [RejectMasterController::class, 'destroy'])->name('frontend.reject.master.delete');
            });
        });

        Route::prefix('record')->group(function () {
            Route::get('/plastic', [RecordController::class, 'recordPlastic'])->name('frontend.report.record.plastic');
            Route::get('/inner', [RecordController::class, 'recordInner'])->name('frontend.report.record.inner');
            Route::get('/master', [RecordController::class, 'recordMaster'])->name('frontend.report.record.master');
            Route::get('/semifinish', [RecordController::class, 'recordSemifinish'])->name('frontend.report.record.semifinish');
            Route::get('/finish', [RecordController::class, 'recordFinish'])->name('frontend.report.record.finish');
        });

    });
});

require __DIR__ . '/auth.php';
