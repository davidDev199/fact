<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DespatchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Middleware\CheckCompanySelected;
use App\Models\Despatch;
use App\Models\District;
use App\Models\Invoice;
use App\Services\Sunat\DespatchService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::redirect('/', '/dashboard');

Route::middleware([
    'auth',
])->group(function () {

    Route::middleware([
        CheckCompanySelected::class
    ])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index',])->name('dashboard');
        //Ventas
        Route::get('vouchers', [VoucherController::class, 'index',])->name('vouchers.index');
        Route::get('vouchers/invoice', [VoucherController::class, 'invoice',])->name('vouchers.invoice');
        Route::get('vouchers/note', [VoucherController::class, 'note',])->name('vouchers.note');

        Route::get('despatchs', [DespatchController::class, 'index',])->name('despatchs.index');
        Route::get('despatchs/create', [DespatchController::class, 'create',])->name('despatchs.create');

        Route::resource('clients', ClientController::class);

        //Inventario
        Route::get('products', [ProductController::class, 'index',])->name('products.index');

        Route::get('companies/edit', [CompanyController::class, 'edit',])->name('companies.edit');
        Route::put('companies/update', [CompanyController::class, 'update',])->name('companies.update');
        Route::get('companies/api-token', [CompanyController::class, 'apiToken',])->name('companies.api-token');
        Route::delete('companies', [CompanyController::class, 'destroy',])->name('companies.destroy');

        Route::resource('branches', BranchController::class)
            ->except('show', 'update');
        Route::get('branches/{branch}/series', [BranchController::class, 'series',])->name('branches.series');

        Route::resource('users', UserController::class);

    });

    Route::resource('companies', CompanyController::class)
        ->only(['index', 'create', 'show']);

});

Route::get('documentacion', function () {
    return view('docs');
});

Route::get('prueba', function () {

    $store = [
        '01' => [
            '01' => 'Valor 1',
            '02' => 'Valor 2',
        ]
    ];

    return $store['01']['03'] ?? 'No existe';
});