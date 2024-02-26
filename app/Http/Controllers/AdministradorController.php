<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {

        $administrador = Administrador::with(['user'])->get();

        return Inertia::render('Administrador/Index' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'usuarios' => $administrador
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return Inertia::render('Administrador/Create' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status')
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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


        error_log($id);

        return Inertia::render('Administrador/Edit' , [
            'mustVerifyEmail' => $request->user()->load('userable') instanceof MustVerifyEmail,
            'status' => session('status'),
            'administrador' => $id
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrador $administrador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $administrador)
    {
        //
    }
}
