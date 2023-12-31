<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    if (auth()->check()) {
        // El usuario está autenticado
        return redirect()->route("admin.index");

    } else {
        return view('auth.login');
        // El usuario no está autenticado
    }
});

Route::get('/home', function () {
    return redirect()->route("admin.index");
} );


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


});
