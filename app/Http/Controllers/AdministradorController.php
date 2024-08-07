<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministradorRequest;
use App\Models\Administrador;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {

        $orderBy = $request->input('order_by', 'name'); 
        $direction = $request->input('direction', 'asc');

        $administrador = Administrador::with(['user'])
            ->orderBy($orderBy, $direction)
            ->paginate(10);

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Administrador/Index' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'usuarios' => $administrador,
                    'order_by' => $orderBy,
                    'direction' => $direction
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
                ? Inertia::render('Administrador/Create' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status')
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdministradorRequest $request)
    {
        $administrador = Administrador::create($request->only('name'));
        $user = $administrador->user()->create(['email' => $request->email, "password" =>Hash::make($request->password)]);

        //$administradores = Administrador::with(['user'])->get();

        $user->sendEmailVerificationNotification();


        return $this->index($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrador $administrador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Administrador $id)
    {

        $id->user;

        return  $request->user()->hasVerifiedEmail()
                ? Inertia::render('Administrador/Edit' , [
                    'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
                    'status' => session('status'),
                    'administrador' => $id,
                ])
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')])
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdministradorRequest $request, Administrador $id)
    {
        $id->update($request->only('name'));
        $id->user()->update($request->only('email'));

        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Administrador $id)
    {
        error_log("Destroy");
        error_log($id);


        $id->user()->delete();
        $id->delete();

        return $this->index($request);

    }
}
