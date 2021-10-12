<?php
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\CheckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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

Route::get('/', function () {
    return redirect('/admin');
});
Route::get('/check-employee/{code}/', [CheckController::class, 'checkEmployee'])->name('check.employee')->middleware('protected.view');
Route::get('/down-card-employee/{code}/', [CheckController::class, 'downCardEmployee'])->name('down.card.employee');
Route::get('/download-qr/{code}', [EmployeeController::class, 'downloadQr'])->name('download.qr');
Route::get('/download-img/{code}', [EmployeeController::class, 'downloadPhoto'])->name('download.photo');
Route::get('/apply-code', function () {
    return view('apply-code');
});
Route::patch('/apply-code/update', [CheckController::class, 'applyCode'])->name('apply.code');
Route::post('/verify-password', [CheckController::class, 'verifyPassword'])->name('verify.password');
Route::get('/confirm-password/{code}', [CheckController::class, 'confirmPassword'])->name('confirm.password');

Route::get('/reset', function (){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});
