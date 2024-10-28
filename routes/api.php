<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProductsController;  // Aquí está el controlador correcto, en singular
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas RESTful para departamentos y productos
Route::resource('departments', DepartmentController::class);
Route::resource('products', ProductsController::class);

// Corrección de las rutas adicionales:
Route::get('productsall', [ProductsController::class, 'all']);  // Cambiado a ProductsController
Route::get('productsbydepartment', [ProductsController::class, 'ProductsByDepartment']);  // Cambiado a ProductsController
