<?php

namespace App\Http\Controllers;

use App\Models\TipoOrcamento;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\TipoOrcamentoRequest;

class TipoOrcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $tipo = TipoOrcamento::paginate(10);

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('TipoOrcamento/Index' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'tipoOrcamento' => $tipo
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
                ? Inertia::render('TipoOrcamento/Create' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status')
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoOrcamentoRequest $request)
    {
        TipoOrcamento::create($request->all());

        return $this->index($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(TipoOrcamento $tipoOrcamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, TipoOrcamento $id)
    {
        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('TipoOrcamento/Edit' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'tipoOrcamento' => $id,
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoOrcamentoRequest $request, TipoOrcamento $id)
    {
        $id->update($request->all());
        
        return $this->index($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, TipoOrcamento $id)
    {
        $id->delete();

        return $this->index($request);

    }
}
