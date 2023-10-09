<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComputerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MonitorController;

Route::get('', [HomeController::class,"index"])->name("admin.index");


Route::resource('categories', CategoryController::class)->names("admin.categories");
Route::resource('monitors', MonitorController::class)->names("admin.monitors");
Route::resource('computers', ComputerController::class)->names("admin.computers");
