<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\OrcamentoRequest;
use App\Models\Cliente;
use App\Models\TipoOrcamento;

class OrcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $orcamentos = Orcamento::with(['cliente', 'cliente.empresa', 'tipo_orcamento', 'administrador'])->get();

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

        $tipo = TipoOrcamento::all();
        error_log($tipo);

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Orcamento/Create' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'tipoOrcamento' => $tipo
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

        //$orcamentos = Orcamento::with(['cliente'])->get();

        $this->index($request);

        /*return Inertia::render('Orcamento/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'orcamentos' => $orcamentos
        ]); */
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

        $TipoOrcamento = TipoOrcamento::all();
        error_log($TipoOrcamento);

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Orcamento/Edit' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'orcamento' => $id,
                    'tipoOrcamento' => $TipoOrcamento
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

        $this->index($request);

        /*$orcamentos = Orcamento::with(['cliente'])->get();
        return Inertia::render('Orcamento/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'orcamentos' => $orcamentos
        ]); */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Orcamento $id)
    {
        $id->delete();

        $this->index($request);

        /*$orcamentos = Orcamento::with(['cliente'])->get();
        return Inertia::render('Orcamento/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'orcamentos' => $orcamentos
        ]); */
    }

    public function updateInicioAnalise(Request $request, Orcamento $id)
    {

        error_log("updateInicioAnalise");

        $id->data_inicio_analise = now();
        error_log($request->user()->id);
        $id->administrador_id = $request->user()->id;
        $id->save();

        $this->index($request);

        /*
        $orcamentos = Orcamento::with(['cliente'])->get();
        return Inertia::render('Orcamento/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'orcamentos' => $orcamentos
        ]); */
    }

    public function updateOrcamentoStatus(Request $request, Orcamento $id)
    {

        error_log("updateOrcamentoStatus");

        $id->orcamento_status = $request->orcamento_status;
        error_log($request->user()->id);
        $id->administrador_id = $request->user()->id;
        $id->save();

        $this->index($request);

        /*
        $orcamentos = Orcamento::with(['cliente'])->get();
        return Inertia::render('Orcamento/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'orcamentos' => $orcamentos
        ]); */
    }


}
