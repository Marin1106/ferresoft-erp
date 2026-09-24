<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLADORES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KardexController;

/*
|--------------------------------------------------------------------------
| MODELOS
|--------------------------------------------------------------------------
*/

use App\Models\Product;
use App\Models\Sale;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('welcome');

})->name('home');

/*
|--------------------------------------------------------------------------
| RUTAS AUTENTICADAS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        /*
        |--------------------------------------------------------------------------
        | ESTADÍSTICAS
        |--------------------------------------------------------------------------
        */

        $totalProductos = Product::count();

        $totalStock = Product::sum('stock');

        $valorInventario = Product::selectRaw(
            'SUM(stock * price) as total'
        )->value('total');

        $productosBajos = Product::whereColumn(
            'stock',
            '<=',
            'stock_minimo'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS STOCK BAJO
        |--------------------------------------------------------------------------
        */

        $productosStockBajo = Product::whereColumn(
                'stock',
                '<=',
                'stock_minimo'
            )
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ÚLTIMOS PRODUCTOS
        |--------------------------------------------------------------------------
        */

        $ultimosProductos = Product::latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | VENTAS
        |--------------------------------------------------------------------------
        */

        $ventasTotales = Sale::sum('total');

        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS MÁS VENDIDOS
        |--------------------------------------------------------------------------
        */

        $ventasPorProducto = Sale::with('product')
            ->selectRaw(
                'product_id, SUM(quantity) as total_vendido'
            )
            ->groupBy('product_id')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | VISTA
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboard',
            compact(

                'totalProductos',
                'totalStock',
                'valorInventario',
                'productosBajos',
                'productosStockBajo',
                'ultimosProductos',
                'ventasTotales',
                'ventasPorProducto'

            )
        );

    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PERFIL
    |--------------------------------------------------------------------------
    */

    Route::controller(ProfileController::class)->group(function () {

        Route::get(
            '/profile',
            'edit'
        )->name('profile.edit');

        Route::patch(
            '/profile',
            'update'
        )->name('profile.update');

        Route::delete(
            '/profile',
            'destroy'
        )->name('profile.destroy');

    });

    /*
    |--------------------------------------------------------------------------
    | PRODUCTOS
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'products',
        ProductController::class
    );

    /*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'clients',
        ClientController::class
    );

    /*
    |--------------------------------------------------------------------------
    | PROVEEDORES
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'suppliers',
        SupplierController::class
    );

    /*
    |--------------------------------------------------------------------------
    | VENTAS
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'sales',
        SaleController::class
    );

    /*
    |--------------------------------------------------------------------------
    | FACTURA PDF
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/sales/{sale}/invoice',
        [SaleController::class, 'invoice']
    )->name('sales.invoice');

    /*
    |--------------------------------------------------------------------------
    | FACTURA ELECTRÓNICA (MATIAS API)
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/sales/{sale}/electronic-invoice',
        [SaleController::class, 'sendElectronicInvoice']
    )->name('sales.electronic-invoice');

    Route::post(
        '/sales/{sale}/electronic-invoice/email',
        [SaleController::class, 'emailElectronicInvoice']
    )->name('sales.electronic-invoice.email');

    /*
    |--------------------------------------------------------------------------
    | EXPORTAR EXCEL
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/sales-export',
        [SaleController::class, 'export']
    )->name('sales.export');

    /*
    |--------------------------------------------------------------------------
    | REPORTES
    |--------------------------------------------------------------------------
    */

    Route::controller(ReportController::class)->group(function () {

        Route::get(
            '/reports',
            'index'
        )->name('reports.index');

        Route::get(
            '/reports/pdf',
            'exportPdf'
        )->name('reports.pdf');

    });

    /*
    |--------------------------------------------------------------------------
    | KARDEX
    |--------------------------------------------------------------------------
    */

    Route::controller(KardexController::class)->group(function () {

        Route::get(
            '/kardex',
            'index'
        )->name('kardex.index');

    });

});

/*
|--------------------------------------------------------------------------
| SOLO ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'admin'
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | LOGS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/logs',
        [LogController::class, 'index']
    )->name('logs.index');

    /*
    |--------------------------------------------------------------------------
    | USUARIOS
    |--------------------------------------------------------------------------
    */

    Route::controller(UserController::class)->group(function () {

        Route::get(
            '/users',
            'index'
        )->name('users.index');

        Route::get(
            '/users/create',
            'create'
        )->name('users.create');

        Route::post(
            '/users',
            'store'
        )->name('users.store');

        Route::get(
            '/users/{user}/edit',
            'edit'
        )->name('users.edit');

        Route::put(
            '/users/{user}',
            'update'
        )->name('users.update');

        Route::post(
            '/users/{user}/toggle',
            'toggle'
        )->name('users.toggle');

        Route::delete(
            '/users/{user}',
            'destroy'
        )->name('users.destroy');

    });

});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';