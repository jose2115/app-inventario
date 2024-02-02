<?php

use App\Http\Controllers\usersController\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum']], function () {
    
    //agregar la rutas aqui cuando el login, roles y permisos esta implementado
    //registrode user
    Route::post('register/user',         [UserController::class, 'register'])->middleware('permission:create_users');
    Route::post('update/user/{id}',      [UserController::class, 'update'])->middleware('permission:update_users');
    Route::get('list/user',              [UserController::class, 'index'])->middleware('permission:see_users');
    Route::get('show/user',              [UserController::class, 'show']);

    Route::post('change/password',      [UserController::class, 'changePassword']);

    //cambiar de estado el usuario
    Route::get('changeState/user/{id}',       [UserController::class, 'changeState'])->middleware('permission:delete_users');


    Route::get('role/list',                                          [UserController::class, 'roles']);
    Route::get('config/roles/list',                                  [UserController::class, 'rolesConfig']);
    Route::get('all/permission',                                     [UserController::class, 'permissions']);
    Route::get('role/{role_id}/permission/{permission_id}/{accion}', [UserController::class, 'assignedPermissions']);
    Route::get('role/permissions/list/{id}',                         [UserController::class, 'listPermissionsRole']);
    


});


Route::group(['middleware' => ['auth:sanctum']], function () {

    //salir del sistema

    Route::get('logout',       [UserController::class, 'logout']);

    Route::get('user/profile', [UserController::class, 'show']);

    Route::post('user/upload', [UserController::class, 'upload']);

    Route::put('user/update/{id}', [UserController::class, 'update']);

});


    

    Route::post('login',                 [UserController::class, 'login']);


    //registro de usuario prueba
    Route::post('register/user/prueba',  [UserController::class, 'prueba']);


    //resetear contraseña
    Route::post('forgot/password', [UserController::class, 'forgot']);
    Route::post('reset/password', [UserController::class, 'reset']);









