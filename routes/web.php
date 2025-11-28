<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TankPrintController;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/tanks/print/{tank}', [TankPrintController::class, 'print'])->name('tanks.print');
