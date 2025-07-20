<?php

namespace App\Http\Controllers;

use App\Models\Veterinario;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
    public function index()
    {
        $veterinarios = Veterinario::all();
        return view('veterinarios.index', compact('veterinarios'));
    }

    public function create()
    {
        return view('veterinarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:veterinarios,email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'especialidad' => 'required|in:cirugía,dermatología,cardiología,neurología,oncología,ortopedia,endocrinología,gastroenterología,odontología',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'descripcion' => 'nullable|string',
        ]);

        Veterinario::create($request->all());
        return redirect()->route('veterinarios.index')->with('success', 'Veterinario creado con éxito.');
    }

    public function show(Veterinario $veterinario)
    {
        return view('veterinarios.show', compact('veterinario'));
    }

    public function edit(Veterinario $veterinario)
    {
        return view('veterinarios.edit', compact('veterinario'));
    }

    public function update(Request $request, Veterinario $veterinario)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:veterinarios,email,' . $veterinario->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'especialidad' => 'required|in:cirugía,dermatología,cardiología,neurología,oncología,ortopedia,endocrinología,gastroenterología,odontología',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'descripcion' => 'nullable|string',
        ]);

        $veterinario->update($request->all());
        return redirect()->route('veterinarios.index')->with('success', 'Veterinario actualizado con éxito.');
    }

    public function destroy(Veterinario $veterinario)
    {
        $veterinario->delete();
        return redirect()->route('veterinarios.index')->with('success', 'Veterinario eliminado con éxito.');
    }
}