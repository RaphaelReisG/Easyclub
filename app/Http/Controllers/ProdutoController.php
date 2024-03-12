<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\ProdutoRequest;
use App\Models\Tipo_Produto;
use App\Models\Fornecedor;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $produtos = Produto::with(['fornecedor', 'tipo_produto'])->get();

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Produto/Index' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'produtos' => $produtos
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $fornecedores = Fornecedor::all();
        $tipo_produtos = Tipo_Produto::all();

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Produto/Create' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'fornecedores' => $fornecedores,
                    'tipo_produtos' => $tipo_produtos,
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdutoRequest $request)
    {

        error_log($request);

        Produto::create($request->all());

        $produtos = Produto::with(['fornecedor', 'tipo_produto'])->get();


        return Inertia::render('Produto/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'produtos' => $produtos
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Produto $id)
    {
        $fornecedores = Fornecedor::all();
        $tipo_produtos = Tipo_Produto::all();
        $id->user;

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Produto/Edit' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'produto' => $id,
                    'fornecedores' => $fornecedores,
                    'tipo_produtos' => $tipo_produtos,
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdutoRequest $request, Produto $id)
    {
        $id->update($request->all());

        $produtos = Produto::with(['fornecedor', 'tipo_produto'])->get();
        return Inertia::render('Produto/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'produtos' => $produtos
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Produto $id)
    {
        $id->delete();

        $produtos = Produto::with(['fornecedor', 'tipo_produto'])->get();
        return Inertia::render('Produto/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'produtos' => $produtos
        ]); 
    }
}
