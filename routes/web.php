<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NormController;
use App\Http\Controllers\CommitmentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ReportController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::prefix('admin')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('norm', NormController::class);
    Route::post('/norm/importar', [NormController::class, 'import'])->name('norm.import');

    Route::resource('commitment', CommitmentController::class);
    Route::post('/commitment/importar', [CommitmentController::class, 'import'])->name('commitment.import');

    //Route::resource('activity', ActivityController::class);
    //Route::post('/activity/importar', [ActivityController::class, 'import'])->name('activity.import');

    Route::resource('report', ReportController::class);
    Route::get('/report/{id}/documentos', [ReportController::class, 'document'])->name('report.document');

    Route::post('/find-cotizacion-ajax', [AdminController::class, 'findCotizacionAjax'])->name('admin.find.cotizacion.ajax');
});
