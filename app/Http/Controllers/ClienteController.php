<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Empresa;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
{
    error_log("Tipo: "); 
    error_log($request->user()->userable_type);

    if ($request->user()->userable_type == "App\Models\Administrador") {
        $clientes = Cliente::with(['user', 'empresa'])->paginate(10);
    } else {
        error_log("ID empresa: ");
        error_log($request->user()->userable->empresa_id);
        $clientes = Cliente::with(['user', 'empresa'])
            ->where("empresa_id", "=", $request->user()->userable->empresa_id)
            ->paginate(10);
    }

    return  $request->user()->hasVerifiedEmail()
            ? Inertia::render('Cliente/Index', [
                'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                'status' => session('status'),
                'usuarios' => $clientes
            ])
            : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $empresas = Empresa::all();

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Cliente/Create' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'empresas' => $empresas
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest $request)
    {

        //error_log("Store");
        //error_log($request->name);
        $cliente = Empresa::findOrfail($request->empresa_id)->clientes()->create($request->all());

        //$cliente = Cliente::create($request->only('name'));
        $user = $cliente->user()->create(['email' => $request->email, "password" =>Hash::make($request->password)]);

        //$clientes = Cliente::with(['user', 'empresa'])->get();

        $user->sendEmailVerificationNotification();


        return $this->index($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Cliente $id)
    {
        $empresas = Empresa::all();
        $id->user;

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Cliente/Edit' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'cliente' => $id,
                    'empresas' => $empresas
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request, Cliente $id)
    {
        $id->update($request->only('name', 'empresa_id'));
        $id->user()->update($request->only('email'));

        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Cliente $id)
    {
        $id->user()->delete();
        $id->delete();

        

        return $this->index($request);
    }
}
