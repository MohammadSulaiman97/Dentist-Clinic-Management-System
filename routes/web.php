<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesAttachmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\InvoiceController;

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

Route::group(['middleware' => ['guest']],function (){
    Route::get('/', function () {
        return view('auth.login');
    });
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('patient'   , PatientController::class);

Route::resource('invoices', InvoiceController::class);

Route::resource('InvoiceAttachments', InvoicesAttachmentController::class);




/* ...................................InvoiceController............................................... */

Route::get('show_patient/{patient}', [PatientController::class, 'show'])->name('show_patient');

Route::get('edit_patient/{patient}', [PatientController::class, 'edit'])->name('edit_patient');



Route::get('export_patients', [PatientController::class,'export'])->name('export_patients');









Route::get('/{page}', [App\Http\Controllers\AdminController::class, 'index']);



