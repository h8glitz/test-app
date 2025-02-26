<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Маршруты для товаров (CRUD)
Route::resource('products', ProductController::class);

// Маршруты для заказов (CRUD)
Route::resource('orders', OrderController::class);

// Дополнительный маршрут для смены статуса заказа
Route::post('orders/{order}/complete', [OrderController::class, 'complete'])
    ->name('orders.complete');
