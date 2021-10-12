<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AppliedCodeController;

Route::get('/', [HomeController::class, 'index'])->name('home.dashboard');
Route::middleware(['can:view.employees'])->get('/view-employees', [EmployeeController::class, 'index'])->name('view.employees');
Route::get('/getEmployee/{id}', [EmployeeController::class, 'show'])->name('get.employee.byId');
Route::get('/tableEmployees', [EmployeeController::class, 'tableEmployees'])->name('table.employees');
Route::post('/employee/create', [EmployeeController::class, 'create'])->name('create.employee');
Route::delete('/employee/destroy', [EmployeeController::class, 'destroy'])->name('delete.eployee');
Route::patch('/employee/update', [EmployeeController::class, 'update'])->name('update.eployee');
Route::patch('/employee/down-date', [EmployeeController::class, 'downDate'])->name('down.date.eployee');
Route::get('/getEmployees', [EmployeeController::class, 'getEmployees'])->name('get.employees');


//Routes Codes
Route::middleware(['can:view.applied.codes'])->get('/view-applied-codes', [AppliedCodeController::class, 'index'])->name('view.applied.codes');
Route::get('/getCodes', [AppliedCodeController::class, 'getAll']);
Route::get('/getDiscCode', [AppliedCodeController::class, 'getCode'])->name('get.disc.code');
Route::post('/code/create', [AppliedCodeController::class, 'create'])->name('create.code');
Route::get('/getCode/{id}', [AppliedCodeController::class, 'show'])->name('get.code.byId');
Route::patch('/code/update', [AppliedCodeController::class, 'update'])->name('update.code');
Route::delete('/code/destroy', [AppliedCodeController::class, 'destroy'])->name('delete.code');

/* Route::get('/apply-token', function () {
    $token = new Token();
    $token->password = Hash::make('Sh@ddai_1');
    $token->remember_token = Str::random(10);
    $token->save();
}); */