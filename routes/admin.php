<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\Admin\AirLineController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CompanyFieldController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\FlightTicketController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\TourismFileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/admin',
    'as' => 'admin.',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::resource('airlines', AirLineController::class);
    Route::resource('currencies', CurrencyController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('company_fields', CompanyFieldController::class);
    Route::resource('tourism_files', TourismFileController::class);
    Route::resource('flight_tickets', FlightTicketController::class);
    Route::get('delete_transite/{id}' ,[FlightTicketController::class , 'deleteTransite']  )->name('delete_transite');


    ########################### Accounts ################################
    Route::controller(AccountsController::class)->group(function (){
        Route::get('/accounts', 'index')->name('acc_index');
        Route::get('/accounts/create', 'create')->name('acc_create');
        Route::post('/accounts/store', 'store')->name('acc_store');
        Route::get('/accounts/{id}/edit', 'edit')->name('acc_edit');
        Route::post('/accounts/{id}/update', 'update')->name('acc_update');
        // Route::get('/{id}/show', 'show')->name('show');
        Route::get('/accounts/{id}/delete' , 'delete')->name('acc_delete');
        // Route::post('delete-selected' , 'deleteAll')->name('delete_selceted');
    });



    ##########################invoices##################################
    Route::post('generate_invoice' , [InvoiceController::class , 'generateInvoice'])->name('generate_invoice');
    Route::get('invoice-show/{id?}'   , [InvoiceController::class , 'show'])->name('invoices.show');
    Route::resource('invoices'   , InvoiceController::class )->except('show');
    Route::post('getmsg/{id}' , [InvoiceController::class , 'printAndGetData']);

    Route::get('fff' , function (){
      return  view('admin/invoices/print');
    } );
});



