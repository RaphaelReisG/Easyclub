<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\OrcamentoRequest;
use App\Models\Cliente;

class OrcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $orcamentos = Orcamento::with(['cliente'])->get();

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Orcamento/Index' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'orcamentos' => $orcamentos
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
                ? Inertia::render('Orcamento/Create' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status')
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrcamentoRequest $request)
    {
        //error_log($request);

        Orcamento::create($request->all());

        $orcamentos = Orcamento::with(['cliente'])->get();

        return Inertia::render('Orcamento/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'orcamentos' => $orcamentos
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Orcamento $orcamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Orcamento $id)
    {
        //$id->user;

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Orcamento/Edit' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'orcamento' => $id,
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrcamentoRequest $request, Orcamento $id)
    {
        $id->update($request->all());

        $orcamentos = Orcamento::with(['cliente'])->get();
        return Inertia::render('Orcamento/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'orcamentos' => $orcamentos
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Orcamento $id)
    {
        $id->delete();

        $orcamentos = Orcamento::with(['cliente'])->get();
        return Inertia::render('Orcamento/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'orcamentos' => $orcamentos
        ]); 
    }
}
