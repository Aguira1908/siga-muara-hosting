
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\Admin\PaymentMethodController;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Galeri publik
Route::get('/galeri', [GalleryController::class, 'index'])
    ->name('gallery.index');

// Laporan warga
Route::get('/lapor', [ReportController::class, 'create'])
    ->name('reports.create');

Route::post('/lapor', [ReportController::class, 'store'])
    ->name('reports.store');

Route::get('/lapor/sukses/{ticket_number}', [ReportController::class, 'success'])
    ->name('reports.success');

// Pelacakan laporan
Route::get('/lacak', [ReportController::class, 'trackForm'])
    ->name('reports.track');

Route::get('/lacak/{ticket_number}', [ReportController::class, 'trackResult'])
    ->name('reports.track.result');

Route::post('/lacak-hp', [ReportController::class, 'trackByPhone'])
    ->middleware('throttle:5,1')
    ->name('reports.track.phone');

// Komentar warga
Route::post('/lacak/{ticket_number}/komentar', [ReportController::class, 'storeComment'])
    ->middleware('throttle:5,1')
    ->name('reports.comments.store');

// Dukungan publik
Route::get('/dukungan', [SupportController::class, 'create'])
    ->name('supports.create');

Route::post('/dukungan', [SupportController::class, 'store'])
    ->name('supports.store');

Route::get('/dukungan/ringkasan', [SupportController::class, 'summary'])
    ->name('supports.summary');

// Kegiatan publik
Route::get('/kegiatan', [ActivityController::class, 'index'])
    ->name('activities.index');

Route::get('/kegiatan/{id}', [ActivityController::class, 'show'])
    ->whereNumber('id')
    ->name('activities.show');

Route::post('/kegiatan/{id}/daftar', [ActivityController::class, 'register'])
    ->whereNumber('id')
    ->middleware('throttle:5,1')
    ->name('activities.register');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.process');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
|
| Semua halaman admin wajib melalui autentikasi.
|
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | KELOLA LAPORAN
        |--------------------------------------------------------------------------
        */

        Route::post('/reports/{id}/update-status', [AdminDashboardController::class, 'updateStatus'])
            ->whereNumber('id')
            ->name('admin.reports.update-status');

        Route::delete('/reports/{id}', [AdminDashboardController::class, 'destroyReport'])
            ->whereNumber('id')
            ->name('admin.reports.destroy');

        Route::post('/reports/{id}/comments', [AdminDashboardController::class, 'replyComment'])
            ->whereNumber('id')
            ->name('admin.reports.comments.reply');


        /*
        |--------------------------------------------------------------------------
        | KELOLA KEGIATAN
        |--------------------------------------------------------------------------
        */

        Route::get('/activities', [AdminDashboardController::class, 'activities'])
            ->name('admin.activities');

        Route::get('/activities/create', [AdminDashboardController::class, 'createActivity'])
            ->name('admin.activities.create');

        Route::post('/activities', [AdminDashboardController::class, 'storeActivity'])
            ->name('admin.activities.store');

        Route::get('/activities/{id}/edit', [AdminDashboardController::class, 'editActivity'])
            ->whereNumber('id')
            ->name('admin.activities.edit');

        Route::put('/activities/{id}', [AdminDashboardController::class, 'updateActivity'])
            ->whereNumber('id')
            ->name('admin.activities.update');

        Route::delete('/activities/{id}', [AdminDashboardController::class, 'destroyActivity'])
            ->whereNumber('id')
            ->name('admin.activities.destroy');


        /*
        |--------------------------------------------------------------------------
        | KELOLA RELAWAN
        |--------------------------------------------------------------------------
        */

        Route::post('/volunteers/{id}/update-status', [AdminDashboardController::class, 'updateVolunteerStatus'])
            ->whereNumber('id')
            ->name('admin.volunteers.update-status');


        /*
        |--------------------------------------------------------------------------
        | KELOLA DUKUNGAN
        |--------------------------------------------------------------------------
        */

        Route::get('/supports', [AdminDashboardController::class, 'supports'])
            ->name('admin.supports');

        Route::post('/supports/{id}/update-status', [AdminDashboardController::class, 'updateSupportStatus'])
            ->whereNumber('id')
            ->name('admin.supports.update-status');

        Route::delete('/supports/{id}', [AdminDashboardController::class, 'destroySupport'])
            ->whereNumber('id')
            ->name('admin.supports.destroy');


        /*
        |--------------------------------------------------------------------------
        | KELOLA METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        Route::get('/payment-methods', [PaymentMethodController::class, 'index'])
            ->name('admin.payment-methods.index');

        Route::post('/payment-methods', [PaymentMethodController::class, 'store'])
            ->name('admin.payment-methods.store');

        Route::put('/payment-methods/{id}', [PaymentMethodController::class, 'update'])
            ->whereNumber('id')
            ->name('admin.payment-methods.update');

        Route::delete('/payment-methods/{id}', [PaymentMethodController::class, 'destroy'])
            ->whereNumber('id')
            ->name('admin.payment-methods.destroy');


        /*
        |--------------------------------------------------------------------------
        | KELOLA GALERI ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/galeri', [AdminGalleryController::class, 'index'])
            ->name('admin.galeri.index');

        Route::post('/galeri', [AdminGalleryController::class, 'store'])
            ->name('admin.galeri.store');

        Route::delete('/galeri/{id}', [AdminGalleryController::class, 'destroy'])
            ->whereNumber('id')
            ->name('admin.galeri.destroy');

    });
