<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    /**
     * LOGIN ROUTES...
     */

    Route::post('login', [LoginController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::prefix('empresas')->group(function () {
            Route::get('', [Controller::class, 'index'])->name('empresas.index');
            // Route::get('create', [Controller::class, 'create'])->name('empresas.create');
            Route::post('', [Controller::class, 'store'])->name('empresas.store');
            Route::get('{id}', [Controller::class, 'show'])->name('empresas.show');
            // Route::get('{id}/edit', [Controller::class, 'edit'])->name('empresas.edit');
            Route::put('{id}', [Controller::class, 'update'])->name('empresas.update');
            Route::delete('{id}', [Controller::class, 'destroy'])->name('empresas.destroy');
        });

        Route::prefix('estagios')->group(function () {
            Route::get('', [Controller::class, 'index'])->name('estagios.index');
            // Route::get('create', [Controller::class, 'create'])->name('estagios.create');
            Route::post('', [Controller::class, 'store'])->name('estagios.store');
            Route::get('{id}', [Controller::class, 'show'])->name('estagios.show');
            // Route::get('{id}/edit', [Controller::class, 'edit'])->name('estagios.edit');
            Route::put('{id}', [Controller::class, 'update'])->name('estagios.update');
            Route::delete('{id}', [Controller::class, 'destroy'])->name('estagios.destroy');
        });

        Route::prefix('alunos')->group(function () {
            Route::get('', [Controller::class, 'index'])->name('alunos.index');
            // Route::get('create', [Controller::class, 'create'])->name('alunos.create');
            Route::post('', [Controller::class, 'store'])->name('alunos.store');
            Route::get('{id}', [Controller::class, 'show'])->name('alunos.show');
            // Route::get('{id}/edit', [Controller::class, 'edit'])->name('alunos.edit');
            Route::put('{id}', [Controller::class, 'update'])->name('alunos.update');
            Route::delete('{id}', [Controller::class, 'destroy'])->name('alunos.destroy');
        });

        Route::prefix('turmas')->group(function () {
            Route::get('', [Controller::class, 'index'])->name('turmas.index');
            // Route::get('create', [Controller::class, 'create'])->name('turmas.create');
            Route::post('', [Controller::class, 'store'])->name('turmas.store');
            Route::get('{id}', [Controller::class, 'show'])->name('turmas.show');
            // Route::get('{id}/edit', [Controller::class, 'edit'])->name('turmas.edit');
            Route::put('{id}', [Controller::class, 'update'])->name('turmas.update');
            Route::delete('{id}', [Controller::class, 'destroy'])->name('turmas.destroy');
        });

        Route::prefix('solicitacoes')->group(function () {
            Route::get('', [Controller::class, 'index'])->name('solicitacoes.index');
            // Route::get('create', [Controller::class, 'create'])->name('solicitacoes.create');
            Route::post('', [Controller::class, 'store'])->name('solicitacoes.store');
            Route::get('{id}', [Controller::class, 'show'])->name('solicitacoes.show');
            // Route::get('{id}/edit', [Controller::class, 'edit'])->name('solicitacoes.edit');
            Route::put('{id}', [Controller::class, 'update'])->name('solicitacoes.update');
            Route::delete('{id}', [Controller::class, 'destroy'])->name('solicitacoes.destroy');
        });

    });
});
