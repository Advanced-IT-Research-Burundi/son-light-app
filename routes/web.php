<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProformaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProformaInvoiceController;
use App\Http\Controllers\ProformaInvoiceListController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockMovementController;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\ProformaInvoice;
use Illuminate\Support\Facades\Route;

//Route::view('/', 'welcome');

Route::get('/', function(){
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function(){
    Route::get('dashboard', [DashboardController::class , 'dashboard'])->name('dashboard');
    Route::view('profile', 'profile');
    Route::resource('users', UserController::class);
    Route::resource('orders', controller: OrderController::class);
    Route::resource('proforma_invoices', controller: ProformaInvoiceController::class);
    Route::resource('clients', ClientController::class);
    Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');
    Route::resource('stocks', StockController::class);
    Route::post('stock-movements', [StockMovementController::class, 'store'])->name('stock-movements.store');

    Route::resource('tasks', App\Http\Controllers\TaskController::class);

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::resource('material-usages', App\Http\Controllers\MaterialUsageController::class);
    Route::resource('payments', App\Http\Controllers\PaymentController::class);
    Route::resource('reports', App\Http\Controllers\ReportController::class);
    Route::resource('detail-orders', App\Http\Controllers\DetailOrderController::class);
    Route::get('rapport-generale', [ReportController::class, 'rapportgenerale'])->name('rapport-generale');
    Route::resource('orders.detail-orders', DetailOrderController::class)->except(['index', 'show']);
    Route::resource('proforma_invoices.proforma_invoice_lists', ProformaInvoiceListController::class)->except(['index', 'show']);
    Route::resource('proforma_invoices.orders', OrderController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('proformas', ProformaController::class);
    //Route::get('proforma_invoices/{proforma_invoice}/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('proforma_invoices/{proforma_invoice}/orders/index', [OrderController::class, 'index'])->name('orders.index');
   // Route::get('proforma_invoices/{proforma_invoice}/orders/show', [OrderController::class, 'show'])->name('orders.show');
    Route::get('orders/{order}/proformas/create', [ProformaController::class, 'create'])->name('proformas.create');
    //Route::post('proforma_invoices/{proforma_invoice}/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('orders/{order}/proformas', [ProformaController::class, 'store'])->name('proformas.store');
    Route::get('proformas/{proforma}/generate-pdf', [ProformaController::class, 'generatePDF'])->name('proformas.generatePDF');
    Route::get('proforma_invoices/{proforma_invoice}/generate-pdf', [ProformaInvoiceController::class, 'generatePDF'])->name('proforma_invoices.generatePDF');
    // Dans routes/web.php

Route::resource('invoices', InvoiceController::class)->except(['edit', 'update', 'destroy']);
Route::get('orders/{order}/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
//Route::post(uri: 'proformas/{proforma}', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('invoices/{invoice}/generate-pdf', [InvoiceController::class, 'generatePDF'])->name('invoices.generatePDF');
Route::get('orders/{order}/generate-pdf', [OrderController::class, 'generatePDF'])->name('orders.generatePDF');
Route::post('addselect',[DetailOrderController::class,'addselect'])->name('addselect');
Route::get('order_alllist',[OrderController::class,'order_alllist'])->name('order_alllist');

});
require_once __DIR__.'/auth.php';







