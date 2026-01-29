<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\Admin\AirLineController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CompanyFieldController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\FlightTicketController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\ShiftController;
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
    Route::get('delete_transite/{id}', [FlightTicketController::class, 'deleteTransite'])->name('delete_transite');


    ########################### Accounts ################################
    Route::controller(AccountsController::class)->group(function () {
        Route::get('/accounts', 'index')->name('acc_index');
        Route::get('/accounts/create', 'create')->name('acc_create');
        Route::post('/accounts/store', 'store')->name('acc_store');
        Route::get('/accounts/{id}/edit', 'edit')->name('acc_edit');
        Route::post('/accounts/{id}/update', 'update')->name('acc_update');
        // Route::get('/{id}/show', 'show')->name('show');
        Route::get('/accounts/{id}/delete', 'delete')->name('acc_delete');
        // Route::post('delete-selected' , 'deleteAll')->name('delete_selceted');
    });


    ##########################invoices##################################
    Route::post('generate_invoice', [InvoiceController::class, 'generateInvoice'])->name('generate_invoice');
    Route::get('invoice-show/{id?}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::resource('invoices', InvoiceController::class)->except('show');
    Route::get('fff', function () {
        return view('admin/invoices/print');
    });


    /***************************************excel and print ajax routes*******************/
    Route::post('getmsg/{id}', [InvoiceController::class, 'printAndGetData']); // for single invoice
    Route::post('invoice_all', [InvoiceController::class, 'getAllData']); //print all invoices
    Route::post('airlines_all', [AirLineController::class, 'getAllData']); //print all invoices
    Route::post('clients_all', [ClientController::class, 'getAllData']); //print all invoices
    Route::post('company_fields_all', [CompanyFieldController::class, 'getAllData']); //print all invoices
    Route::post('currencies_all', [CurrencyController::class, 'getAllData']); //print all currencies
    Route::post('flight_tickets_all', [FlightTicketController::class, 'getAllDataPrint']); //print all currencies
    Route::post('tourism_files_all', [TourismFileController::class, 'getAllData']); //print all currencies
    Route::post('receipts_all/{type}', [ReceiptController::class, 'getAllData']); //print all receipts


    /***************************************end excel and print ajax routes*******************/
    Route::get('receipt/{type}', [ReceiptController::class, 'index'])->name('receipt.index');
    Route::get('receipt/create/{type}', [ReceiptController::class, 'create'])->name('receipt.create');
    Route::post('receipt/store/{type}', [ReceiptController::class, 'store'])->name('receipt.store');
    Route::get('receipt/show/{type}/{id}', [ReceiptController::class, 'show'])->name('receipt.show');
    Route::get('receipt/edit/{type}/{id}', [ReceiptController::class, 'edit'])->name('receipt.edit');
    Route::put('receipt/update/{type}/{id}', [ReceiptController::class, 'update'])->name('receipt.update');
    Route::delete('receipt/delete/{type}/{id}', [ReceiptController::class, 'destroy'])->name('receipt.destroy');


    Route::get('open_shift', [ShiftController::class, 'openShift'])->name('shift.open');
    Route::get('close_shift', [ShiftController::class, 'closeShift'])->name('shift.close');


    ###################################livewire##################################
    Route::livewire('/receipt_accounts_get', ' pages::admin.receipt_accounts.get');


});



