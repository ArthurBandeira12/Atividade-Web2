<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funcionarios = Funcionarios::all();
        return view('funcionarios.index', compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Funcionarios::create($request->all());
        return redirect()->route('funcionarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Funcionarios $funcionario)
    {
        return view('funcionarios.show', compact('funcionario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcionarios $funcionario)
    {
      return view('funcionarios.edit', compact('funcionario'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcionarios $funcionario)
    {
        $funcionario->update($request->all());

       return redirect()->route('funcionarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionarios $funcionario)
    {
        $funcionario->delete();
        return redirect()->route('funcionarios.index');
    }
}
