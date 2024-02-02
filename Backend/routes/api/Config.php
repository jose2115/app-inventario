<?php

use App\Http\Controllers\dataController\DataController;
use App\Http\Controllers\InventarioController\InventarioController;
use App\Http\Controllers\productsController\ProductsController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum']], function () {
    
    //agregar la rutas aqui cuando el login, roles y permisos esta implementado

    Route::get('/list/zonas', [InventarioController::class, 'listZonas']);
    Route::get('/list/public/zonas', [InventarioController::class, 'listZonasPublic']);
    Route::post('/create/zona', [InventarioController::class, 'createZona']);
    Route::post('/update/zona/{id}', [InventarioController::class, 'updateZona']);
    Route::delete('/delete/zona/{id}', [InventarioController::class, 'deleteZona']);

    //subir data de propuestas
    Route::post('/upload/data', [DataController::class, 'dataProducts']);

    Route::get('/select/excel/{id}', [DataController::class, 'selectExcel' ]);

    //eliminar excel
    Route::delete('/delete/excel/{id}', [DataController::class, 'deleteExcel']);

    Route::get('/list/excel', [DataController::class, 'ListExcel']);


    //productos

    Route::get('/list/products', [ProductsController::class, 'List']);


    //inventario

    Route::get('/list/inventario', [InventarioController::class, 'listInventario']);
    Route::post('/create/inventario', [InventarioController::class, 'createInventario']);

    Route::get('/select/inventario/{id}', [InventarioController::class, 'Select']);

    Route::post('/add/items/inventario', [InventarioController::class, 'createDetailsInventario']);

    Route::delete('/delete/inventario/{id}', [InventarioController::class, 'deleteInventario']);


    //zona

    


    //productos contados

    Route::get('/historial/list', [InventarioController::class, 'historial']);

});


    










