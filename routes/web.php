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
    return view('welcome');
});

Route::get('/elektre', [HasilEvaluasiModelController::class, 'index']);
Route::get('/elektre/result', [HasilEvaluasiModelController::class, 'result']);
Route::get('/elektre/alternatif', [HasilEvaluasiModelController::class, 'getAlternatives']);
Route::get('/elektre/kriteria', [HasilEvaluasiModelController::class, 'getCriterias']);
