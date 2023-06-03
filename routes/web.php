<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\EmployeeController;
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

Route::get('/login', [CustomAuthController::class,'login']);

Route::get('/registration', [CustomAuthController::class,'registration'])->name('registration.form');

Route::get('/register-user',[CustomAuthController::class,'registerUser'])->name('register-user');

Route::any('/login-user',[CustomAuthController::class,'loginUser'])->name('login-user');
Route::get('/dashboard',[CustomAuthController::class,'dashboard'])->middleware('isLoggedIn');
// Route::get('/employees',[CustomAuthController::class,'employees'])->middleware('isLoggedIn');
Route::get('/logout',[CustomAuthController::class,'logout']);
Route::any('/login-admin',[CustomAuthController::class,'loginUser'])->name('login-admin');



// for employees
Route::get('/employees',[EmployeeController::class,'index'])->name('employees.index');
Route::get('/employees/create',[EmployeeController::class,'create'])->name('employees.create');
// when form will submit
Route::post('/employees',[EmployeeController::class,'store'])->name('employees.store');
Route::get('/employees/{employee}/edit',[EmployeeController::class,'edit'])->name('employees.edit');

Route::get('/employees/{employee}',[EmployeeController::class,'update'])->name('employees.update');
Route::delete('/employees/{employee}',[EmployeeController::class,'destroy'])->name('employees.destroy');










// Route::get('/employees',[EmployeeController::class,'index'])->name('employees.index');
// Route::get('/employees/create',[EmployeeController::class,'create'])->name('employees.create');
// Route::post('/employees',[EmployeeController::class,'store'])->name('employees.store');
// Route::get('/employees/{employee}/edit',[EmployeeController::class,'edit'])->name('employees.edit');
// Route::put('/employees/{employee}',[EmployeeController::class,'update'])->name('employees.update');
// Route::delete('/employees/{employee}',[EmployeeController::class,'destroy'])->name('employees.destroy');

