<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/forms', [FormController::class, 'index'])->name('admin.forms.formlist');
    Route::get('/admin/forms/create', [FormController::class, 'create'])->name('admin.forms.create');
    Route::post('/admin/forms', [FormController::class, 'store'])->name('admin.forms.store');
    Route::get('/admin/forms/{form}', [FormController::class, 'show'])->name('admin.forms.show');
    Route::get('/admin/forms/{form}/edit', [FormController::class, 'edit'])->name('admin.forms.edit');
    Route::post('/forms/{form}/submit', [FormController::class, 'submit'])->name('form.submit');
    Route::put('/admin/forms/{form}', [FormController::class, 'update'])->name('admin.forms.update');
    Route::delete('/admin/forms/{form}', [FormController::class, 'delete'])->name('admin.forms.delete');
});

require __DIR__ . '/auth.php';
