<?php

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
    return view('pages/landing');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); 

use App\Http\Controllers\CompanyController;
Route::post('store-file',[CompanyController::class,'store']);
Route::post('store-file/{id}',[CompanyController::class,'update']);
Route::post('store-file-destroy/{id}',[CompanyController::class,'destroy']);
Route::post('companylist',[CompanyController::class,'allCompanyDetails']);

//employee/employeelist

use App\Http\Controllers\EmployeeController;
Route::get('employee/{page}',[EmployeeController::class,'index']);
Route::post('employee/employeeDetails',[EmployeeController::class,'store']);
Route::post('employee/employeeDetails/{id}',[EmployeeController::class,'update']);
Route::post('employee/employeelist/{id}',[EmployeeController::class,'allEmployeeDetails']);
Route::post('employee/destroy/{id}',[EmployeeController::class,'destroy']);
//employee/create
// Route::get('employee/create', function () {


//     return view('pages/landing');
// });


// Route::post('updateSrcDetails',[ImageControoler::class,'updateSrcDetails']);
