<?php

use App\Http\Controllers\HasilEvaluasiModelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('electre');
});

Route::get('/electre', [HasilEvaluasiModelController::class, 'index']);
Route::get('/electre/result', [HasilEvaluasiModelController::class, 'result']);
Route::get('/electre/alternatif', [HasilEvaluasiModelController::class, 'getAlternatives']);
Route::get('/electre/kriteria', [HasilEvaluasiModelController::class, 'getCriterias']);
