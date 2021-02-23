<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesAttachmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DentistAppointmentController;
use App\Http\Controllers\PatientAchiveController;

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

Route::resource('DentistAppointments', DentistAppointmentController::class);

Route::resource('Archive', PatientAchiveController::class);


/* ...................................InvoiceController............................................... */

Route::get('/edit_invoice/{id}', 'App\Http\Controllers\InvoiceController@edit');
Route::post('/update_invoice/{id}', 'App\Http\Controllers\InvoiceController@update');

Route::get('/Status_show/{id}', 'App\Http\Controllers\InvoiceController@show')->name('Status_show');
Route::post('/Status_Update/{id}', 'App\Http\Controllers\InvoiceController@Status_Update')->name('Status_Update');

Route::get('/Invoice_Paid', 'App\Http\Controllers\InvoiceController@Invoice_Paid');
Route::get('/Invoice_Partial', 'App\Http\Controllers\InvoiceController@Invoice_Partial');
Route::get('/Invoice_UnPaid', 'App\Http\Controllers\InvoiceController@Invoice_UnPaid');

Route::get('Print_invoice/{id}','App\Http\Controllers\InvoiceController@Print_invoice');



Route::get('export_invoices', 'App\Http\Controllers\InvoiceController@export');


/* .......................................InvoicesDetailsController ........................................... */

Route::get('/InvoicesDetails/{id}', 'App\Http\Controllers\InvoicesDetailController@edit');

Route::get('download/{patient_name}/{file_name}', 'App\Http\Controllers\InvoicesDetailController@get_file');

Route::get('View_file/{patient_name}/{file_name}', 'App\Http\Controllers\InvoicesDetailController@open_file');

Route::post('delete_file', 'App\Http\Controllers\InvoicesDetailController@destroy')->name('delete_file');




/* ...................................PatientController............................................... */

Route::get('show_patient/{patient}', [PatientController::class, 'show'])->name('show_patient');

Route::get('edit_patient/{patient}', [PatientController::class, 'edit'])->name('edit_patient');


Route::get('export_patients', [PatientController::class,'export'])->name('export_patients');


/* .......................................report ........................................... */
Route::get('invoices_report', 'App\Http\Controllers\Invoices_Report@index');

Route::post('Search_invoices', 'App\Http\Controllers\Invoices_Report@Search_invoices');

Route::get('patients_report', 'App\Http\Controllers\Patients_Report@index')->name("patients_report");

Route::post('Search_patients', 'App\Http\Controllers\Patients_Report@Search_patients');




Route::get('/{page}', [App\Http\Controllers\AdminController::class, 'index']);



