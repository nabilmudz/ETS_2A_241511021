<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KomponenGajiController;
use App\Http\Controllers\PenggajianController;

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
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('auth.login');
    }
    if ($user->role === 'Admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
});

Route::prefix('/auth')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('auth.login');
});

Route::prefix('/dashboard')->group(function () {
    Route::prefix('/admin')
        ->middleware(['auth', 'role:Admin'])
        ->group(function () {
            Route::get('/', function () {
                return view('admin.dashboard');
            })->name('admin.dashboard');
            
            Route::prefix('/anggota')->group(function () {
                Route::get('/', [AnggotaController::class, 'index'])->name('admin.anggota.index');
                Route::get('/create', [AnggotaController::class, 'create'])->name('admin.anggota.create');
                Route::post('/', [AnggotaController::class, 'store'])->name('admin.anggota.store');
                Route::get('/{anggota}', [AnggotaController::class, 'show'])->name('admin.anggota.show');
                Route::get('/{anggota}/edit', [AnggotaController::class, 'edit'])->name('admin.anggota.edit');
                Route::put('/{anggota}', [AnggotaController::class, 'update'])->name('admin.anggota.update');
                Route::delete('/{anggota}', [AnggotaController::class, 'destroy'])->name('admin.anggota.destroy'); 
            });

            Route::prefix('/komponen-gaji')->group(function () {
                Route::get('/', [KomponenGajiController::class, 'index'])->name('admin.komponen_gaji.index');
                Route::get('/create', [KomponenGajiController::class, 'create'])->name('admin.komponen_gaji.create');
                Route::post('/', [KomponenGajiController::class, 'store'])->name('admin.komponen_gaji.store');
                Route::get('/{komponenGaji}', [KomponenGajiController::class, 'show'])->name('admin.komponen_gaji.show');
                Route::get('/{komponenGaji}/edit', [KomponenGajiController::class, 'edit'])->name('admin.komponen_gaji.edit');
                Route::put('/{komponenGaji}', [KomponenGajiController::class, 'update'])->name('admin.komponen_gaji.update');
                Route::delete('/{komponenGaji}', [KomponenGajiController::class, 'destroy'])->name('admin.komponen_gaji.destroy'); 
                Route::get('/by-jabatan/{jabatan}', [KomponenGajiController::class, 'showByJabatan'])->name('admin.komponen_gaji.showByJabatan');
            });

            Route::prefix('/penggajian')->group(function () {
                Route::get('/', [PenggajianController::class, 'index'])->name('admin.penggajian.index');
                Route::get('/create', [PenggajianController::class, 'create'])->name('admin.penggajian.create');
                Route::post('/', [PenggajianController::class, 'store'])->name('admin.penggajian.store');
                Route::get('/{id_komponen_gaji}/{id_anggota}', [PenggajianController::class, 'show'])->name('admin.penggajian.show');
                Route::get('/{id_komponen_gaji}/{id_anggota}/edit', [PenggajianController::class, 'edit'])->name('admin.penggajian.edit');
                Route::put('/{id_komponen_gaji}/{id_anggota}', [PenggajianController::class, 'update'])->name('admin.penggajian.update');
                Route::delete('/{id_komponen_gaji}/{id_anggota}', [PenggajianController::class, 'destroy'])->name('admin.penggajian.destroy'); 
            });
        });

    Route::prefix('/public')
        ->middleware(['auth', 'role:Public'])
        ->group(function () {
        Route::get('/', function () {
            return view('user.dashboard');
        })->name('user.dashboard');
        Route::get('/anggota-dpr', [AnggotaController::class, 'index'])->name('admin.anggota.index');
        Route::get('/gaji-dpr', [PenggajianController::class, 'index'])->name('admin.penggajian.index');
    });
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
