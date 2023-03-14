<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\NominationsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('migrate', function () {
    //$exitCode = Artisan::call('migrate:fresh --seed --force');
    $exitCode = Artisan::call('migrate');
    return $exitCode;
});

Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdministrationController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/nominations', [AdministrationController::class, 'nominations'])->name('nominations');
    Route::post('/admin/nominations/search', [AdministrationController::class, 'nominationsSearch'])->name('search-nominations');
    Route::get('/admin/nominations/{id}', [NominationsController::class, 'remove'])->name('deleteNomination');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
