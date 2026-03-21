<?php

use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SiteUserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\ProfileController; 
use App\Http\Controllers\HomeController; 

use App\Models\Service; 
use App\Models\Order;   
use App\Models\Complaint;

/*
|--------------------------------------------------------------------------
| 1. الواجهة الأمامية (Frontend & Public Routes)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact-us', [HomeController::class, 'storeComplaint'])->name('complaints.submit'); 

Route::get('/contact', function () {
    return view('frontend.contect'); 
})->name('contact.index'); 

Route::get('/our-drivers', function () {
    return view('frontend.driver'); 
})->name('drivers.public'); 


/*
|--------------------------------------------------------------------------
| 2. مسارات تسجيل دخول الأدمن (Admin Auth - العامة)
|--------------------------------------------------------------------------
*/
// هذه المسارات يجب أن تكون خارج الـ Middleware لتتمكن من الوصول إليها قبل تسجيل الدخول
Route::get('/admin/login', [ProfileController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [ProfileController::class, 'login'])->name('admin.login.submit');


/*
|--------------------------------------------------------------------------
| 3. لوحة تحكم الأدمن (Admin Panel - المحمية)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    
    // لوحة التحكم الرئيسية
    Route::get('/dashboard', function () {
        $servicesCount = class_exists(Service::class) ? Service::count() : 0;
        $ordersCount = class_exists(Order::class) ? Order::count() : 0;
        $complaintsCount = class_exists(Complaint::class) ? Complaint::count() : 0;
        return view('admin.dashboard', compact('servicesCount', 'ordersCount', 'complaintsCount'));
    })->name('dashboard');

    // --- قسم الملف الشخصي والإعدادات ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password'); 

    // مسار تسجيل الخروج الخاص بالأدمن
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');

    // إدارة السائقين
    Route::get('/drivers', [DriverController::class, 'adminIndex'])->name('drivers.index');
    Route::post('/drivers/approve/{id}', [DriverController::class, 'approve'])->name('drivers.approve');
    Route::delete('/drivers/{id}', [DriverController::class, 'destroy'])->name('drivers.destroy');

    // الموارد الأساسية (CRUD)
    Route::resource('sliders', SliderController::class);
    Route::resource('users', SiteUserController::class);
    Route::resource('services', ServiceController::class); 
    Route::resource('prices', PriceController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('complaints', ComplaintController::class);
}); 


/*
|--------------------------------------------------------------------------
| 4. نظام السائق (Driver Auth System)
|--------------------------------------------------------------------------
*/
Route::get('/driver/register', [DriverController::class, 'showRegisterForm'])->name('driver.register');
Route::post('/driver/register', [DriverController::class, 'register'])->name('driver.register.submit');

// مسار دخول السائق الأساسي
Route::get('/driver/login', [DriverController::class, 'showLoginForm'])->name('login');
Route::post('/driver/login', [DriverController::class, 'login'])->name('driver.login.submit');

Route::middleware('auth:driver')->group(function () {
    
    Route::get('/driver/dashboard', function () {
        return view('frontend.driver-dashboard');
    })->name('driver.dashboard');

    // مسار خروج السائق
    Route::post('/driver/logout', [DriverController::class, 'logout'])->name('driver.logout');
});