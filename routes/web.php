<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
});

Route::prefix('/auth')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('auth.login');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register');
});

Route::prefix('/dashboard')->group(function () {
    
    Route::prefix('/admin')
        ->middleware(['auth', 'role:admin'])
        ->group(function () {
            
            Route::get('/', function () {
                return view('admin.dashboard');
            })->name('admin.dashboard');

            Route::prefix('/test')->group(function () {
                Route::get('/', [TestController::class, 'index'])->name('admin.test.index');
                Route::get('/create', [TestController::class, 'create'])->name('admin.test.create');
                Route::post('/', [TestController::class, 'store'])->name('admin.test.store');
                Route::get('/{test  }', [TestController::class, 'show'])->name('admin.test.show');
                Route::get('/{test  }/edit', [TestController::class, 'edit'])->name('admin.test.edit');
                Route::put('/{test  }', [TestController::class, 'update'])->name('admin.test.update');
                Route::delete('/{test   }', [TestController::class, 'destroy'])->name('admin.test.destroy');
            });
        });
    Route::prefix('/admin')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    Route::prefix('/user')->group(function () {
        Route::get('/', function () {
            return view('user.dashboard');
        })->name('user.dashboard');
    });
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
