<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KardexController;

use App\Models\Product;
use App\Models\Sale;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect()->route('dashboard');

});

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

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

        $productosStockBajo = Product::whereColumn(
                'stock',
                '<=',
                'stock_minimo'
            )
            ->latest()
            ->take(5)
            ->get();

        $ultimosProductos = Product::latest()
            ->take(5)
            ->get();

        $ventasTotales = Sale::sum('total');

        $ventasPorProducto = Sale::with('product')
            ->selectRaw(
                'product_id, SUM(quantity) as total_vendido'
            )
            ->groupBy('product_id')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

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

    /*
    |--------------------------------------------------------------------------
    | LOGS SOLO ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin')->group(function () {

        Route::get(
            '/logs',
            [LogController::class, 'index']
        )->name('logs.index');

    });

});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'admin'
])->group(function () {

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

require __DIR__ . '/auth.php';