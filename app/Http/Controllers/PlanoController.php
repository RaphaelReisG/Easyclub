<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\PlanoRequest;
use App\Models\Produto;


class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $planos = Plano::all();

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Plano/Index' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'planos' => $planos
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $produtos = Produto::all();

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Plano/Create' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'produtos' => $produtos

                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanoRequest $request)
    {
        $plano = Plano::create($request->all());
/*
        $produtosSelecionados = $request->produtos;

        foreach($produtosSelecionados as $ps){
            $produto = Produto::find($ps->id);
            $plano->produtos()->attach($produto,[
                'qty_item' => $ps->qty_item,
                'price_item' => $ps->price_item
            ]);
        }
*/
        $planos = Plano::all();

        return Inertia::render('Plano/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'planos' => $planos
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Plano $plano)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Plano $id)
    {

        $produtos = Produto::all();

        
        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Plano/Edit' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'plano' => $id,
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanoRequest $request, Plano $id)
    {
        $id->update($request->all());

       /* $produtosSelecionados = $request->produtos;

        $id->produtos()->detach();
        foreach($produtosSelecionados as $ps){
            $produto = Produto::find($ps->id);
            $id->produtos()->attach($produto,[
                'qty_item' => $ps->qty_item,
                'price_item' => $ps->price_item
            ]);
        }
        */
        $planos = Plano::all();

        return Inertia::render('Plano/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'planos' => $planos
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Plano $id)
    {
        $id->produtos()->detach();
        $id->empresas()->detach();
        $id->delete();

        $planos = Plano::all();
        return Inertia::render('Plano/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'planos' => $planos
        ]);
    }
}
