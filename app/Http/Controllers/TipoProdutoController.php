<?php

namespace App\Http\Controllers;

use App\Models\Tipo_Produto;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\Tipo_ProdutoRequest;

class TipoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $tipo_Produtos = Tipo_Produto::all();

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Tipo_Produto/Index' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'tipo_Produtos' => $tipo_Produtos
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Tipo_Produto/Create' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status')
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Tipo_ProdutoRequest $request)
    {
        Tipo_Produto::create($request->all());

        $tipo_Produtos = Tipo_Produto::all();

        return Inertia::render('Tipo_Produto/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'tipo_Produtos' => $tipo_Produtos
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Tipo_Produto $tipo_Produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tipo_Produto $id)
    {
        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Tipo_Produto/Edit' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'tipo_Produto' => $id,
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Tipo_ProdutoRequest $request, Tipo_Produto $id)
    {
        $id->update($request->all());
        
        $tipo_Produtos = Tipo_Produto::all();
        return Inertia::render('Tipo_Produto/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'tipo_Produtos' => $tipo_Produtos
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Tipo_Produto $id)
    {
        $id->delete();

        $tipo_Produtos = Tipo_Produto::all();
        return Inertia::render('Tipo_Produto/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'tipo_Produtos' => $tipo_Produtos
        ]); 
    }
}
