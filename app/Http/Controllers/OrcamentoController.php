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
    /*public function index(Request $request): Response
    {
        error_log("Index");
        error_log($request->user());
        $emp = $request->user()->userable->empresa_id;
        error_log($emp);


        $orcamentos = Orcamento::with(['cliente', 'cliente.empresa', 'administrador', 'itemOrcamentos', 'itemOrcamentos.tipo_orcamento' ])->get();

        

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Orcamento/Index' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'orcamentos' => $orcamentos
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }*/

    public function index(Request $request): Response
    {
        error_log("Index");
        error_log($request->user());

        // Obtém o ID da empresa do usuário atual
        $user = $request->user();
        $empresaId = $user->userable->empresa_id;
        error_log($empresaId);

        // Verifica se o usuário é do tipo cliente
        $isCliente = $user->userable instanceof Cliente;

        // Filtra os orçamentos de acordo com a empresa do cliente
        if ($isCliente) {
            $orcamentos = Orcamento::whereHas('cliente', function ($query) use ($empresaId) {
                $query->where('empresa_id', $empresaId);
            })
                ->with(['cliente', 'cliente.empresa', 'administrador', 'itemOrcamentos', 'itemOrcamentos.tipo_orcamento'])
                ->paginate(10);
        } else {
            // Se não for cliente, busca todos os orçamentos
            $orcamentos = Orcamento::with(['cliente', 'cliente.empresa', 'administrador', 'itemOrcamentos', 'itemOrcamentos.tipo_orcamento'])
                ->paginate(10);
        }

        return  $request->user()->hasVerifiedEmail()
            ? Inertia::render('Orcamento/Index', [
                'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                'status' => session('status'),
                'orcamentos' => $orcamentos
            ])
            : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $tipo = TipoOrcamento::all();
        //error_log($tipo);

        return  $request->user()->hasVerifiedEmail()
            ? Inertia::render('Orcamento/Create', [
                'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                'status' => session('status'),

                'tipoOrcamento' => $tipo
            ])
            : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrcamentoRequest $request)
    {
        //error_log($request);

        //error_log($request->itens);

        $orcamento = Orcamento::create($request->all());

        foreach ($request->itens as $item) {
            $orcamento->itemOrcamentos()->create($item);
            //error_log($item);
        }


        return $this->index($request);
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
        error_log($id->itemOrcamentos);

        return  $request->user()->hasVerifiedEmail()
            ? Inertia::render('Orcamento/Edit', [
                'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                'status' => session('status'),
                'orcamento' => $id,
                'tipoOrcamento' => $TipoOrcamento,
                'itemOrcamentos' => $id->itemOrcamentos
            ])
            : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orcamento $id)
    {
        $id->update($request->all());

        $id->itemOrcamentos()->delete();

        foreach ($request->itens as $item) {
            $id->itemOrcamentos()->create($item);
            //error_log($item);
        }


        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Orcamento $id)
    {
        $id->itemOrcamentos()->delete();
        $id->delete();

        return $this->index($request);
    }

    public function updateInicioAnalise(Request $request, Orcamento $id)
    {

        error_log("updateInicioAnalise");

        $id->data_inicio_analise = now();
        error_log($request->user()->id);
        $id->administrador_id = $request->user()->id;
        $id->save();

        return $this->index($request);
    }

    public function carregaPageUpdateOrcamento(Request $request, Orcamento $id)
    {
        //$id->user;

        $TipoOrcamento = TipoOrcamento::all();
        error_log($id->itemOrcamentos);

        return  $request->user()->hasVerifiedEmail()
            ? Inertia::render('Orcamento/Finalizar', [
                'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                'status' => session('status'),
                'orcamento' => $id,
                'tipoOrcamento' => $TipoOrcamento,
                'itemOrcamentos' => $id->itemOrcamentos
            ])
            : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }

    public function updateOrcamentoStatus(Request $request, Orcamento $id)
    {

        error_log("updateOrcamentoStatus");

        $id->orcamento_status = $request->orcamento_status;
        $id->data_encerramento = now();
        $id->response_observation = $request->response_observation;

        //error_log($request->user()->id);
        $id->administrador_id = $request->user()->id;

        $id->save();

        return $this->index($request);
    }
}
