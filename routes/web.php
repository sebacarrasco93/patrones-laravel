<?php

use App\Http\Controllers\FactoryController;
use App\Http\Controllers\FactoryMethodController;
use App\Http\Controllers\PatronesController;
use App\Http\Controllers\PipelineController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'index');

Route::get('factory', [PatronesController::class, 'factory'])->name('patrones.factory');
Route::get('factory-method', [PatronesController::class, 'factoryMethod'])->name('patrones.factoryMethod');
Route::get('pipeline', [PatronesController::class, 'pipeline'])->name('patrones.pipeline');

Route::post('factory/{report}', FactoryController::class)->name('factory');
Route::post('factory-method/{report}', FactoryMethodController::class)->name('factoryMethod');
Route::post('pipeline/{user}', PipelineController::class)->name('pipeline');

