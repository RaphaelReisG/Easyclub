<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\TipoProdutoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\OrcamentoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $user->load('userable'); // Carrega a relação userable

    return Inertia::render('Dashboard', [
        'auth' => [
            'user' => $user,
            // outras informações relacionadas à autenticação, se necessário
        ],
        // outras propriedades necessárias para a página
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Administrador
    Route::get('/administrador', [AdministradorController::class, 'index'])->name('administrador.index');
    Route::get('/administrador/Create', [AdministradorController::class, 'create'])->name('administrador.create');
    Route::get('/administrador/Edit/{id}', [AdministradorController::class, 'edit'])->name('administrador.edit');
    Route::post('/administrador', [AdministradorController::class, 'store'])->name('administrador.store');
    Route::put('/administrador/{id}', [AdministradorController::class, 'update'])->name('administrador.update');
    Route::delete('/administrador/{id}', [AdministradorController::class, 'destroy'])->name('administrador.destroy');

     //Cliente
     Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
     Route::get('/cliente/Create', [ClienteController::class, 'create'])->name('cliente.create');
     Route::get('/cliente/Edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
     Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
     Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
     Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

    //Empresa
    Route::get('/empresa', [EmpresaController::class, 'index'])->name('empresa.index');
    Route::get('/empresa/Create', [EmpresaController::class, 'create'])->name('empresa.create');
    Route::get('/empresa/Edit/{id}', [EmpresaController::class, 'edit'])->name('empresa.edit');
    Route::post('/empresa', [EmpresaController::class, 'store'])->name('empresa.store');
    Route::put('/empresa/{id}', [EmpresaController::class, 'update'])->name('empresa.update');
    Route::delete('/empresa/{id}', [EmpresaController::class, 'destroy'])->name('empresa.destroy');

    //Fornecedor
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('fornecedor.index');
    Route::get('/fornecedor/Create', [FornecedorController::class, 'create'])->name('fornecedor.create');
    Route::get('/fornecedor/Edit/{id}', [FornecedorController::class, 'edit'])->name('fornecedor.edit');
    Route::post('/fornecedor', [FornecedorController::class, 'store'])->name('fornecedor.store');
    Route::put('/fornecedor/{id}', [FornecedorController::class, 'update'])->name('fornecedor.update');
    Route::delete('/fornecedor/{id}', [FornecedorController::class, 'destroy'])->name('fornecedor.destroy');

     //Produto
     Route::get('/produto', [ProdutoController::class, 'index'])->name('produto.index');
     Route::get('/produto/Create', [ProdutoController::class, 'create'])->name('produto.create');
     Route::get('/produto/Edit/{id}', [ProdutoController::class, 'edit'])->name('produto.edit');
     Route::post('/produto', [ProdutoController::class, 'store'])->name('produto.store');
     Route::put('/produto/{id}', [ProdutoController::class, 'update'])->name('produto.update');
     Route::delete('/produto/{id}', [ProdutoController::class, 'destroy'])->name('produto.destroy');

    //Tipo_produto
    Route::get('/tipo_produto', [TipoProdutoController::class, 'index'])->name('tipo_produto.index');
    Route::get('/tipo_produto/Create', [TipoProdutoController::class, 'create'])->name('tipo_produto.create');
    Route::get('/tipo_produto/Edit/{id}', [TipoProdutoController::class, 'edit'])->name('tipo_produto.edit');
    Route::post('/tipo_produto', [TipoProdutoController::class, 'store'])->name('tipo_produto.store');
    Route::put('/tipo_produto/{id}', [TipoProdutoController::class, 'update'])->name('tipo_produto.update');
    Route::delete('/tipo_produto/{id}', [TipoProdutoController::class, 'destroy'])->name('tipo_produto.destroy');

    //Plano
    Route::get('/plano', [PlanoController::class, 'index'])->name('plano.index');
    Route::get('/plano/Create', [PlanoController::class, 'create'])->name('plano.create');
    Route::get('/plano/Edit/{id}', [PlanoController::class, 'edit'])->name('plano.edit');
    Route::post('/plano', [PlanoController::class, 'store'])->name('plano.store');
    Route::put('/plano/{id}', [PlanoController::class, 'update'])->name('plano.update');
    Route::delete('/plano/{id}', [PlanoController::class, 'destroy'])->name('plano.destroy');

    //Orçamento
    Route::get('/orcamento', [OrcamentoController::class, 'index'])->name('orcamento.index');
    Route::get('/orcamento/Create', [OrcamentoController::class, 'create'])->name('orcamento.create');
    Route::get('/orcamento/Edit/{id}', [OrcamentoController::class, 'edit'])->name('orcamento.edit');
    Route::post('/orcamento', [OrcamentoController::class, 'store'])->name('orcamento.store');
    Route::put('/orcamento/{id}', [OrcamentoController::class, 'update'])->name('orcamento.update');
    Route::delete('/orcamento/{id}', [OrcamentoController::class, 'destroy'])->name('orcamento.destroy');
});

require __DIR__.'/auth.php';
