<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('https://gatah.alowairdi.com/');
});
Route::get('/login', [AuthController::class, 'error_message'])->name('login');
