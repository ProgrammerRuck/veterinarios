<?php
namespace App\Http\Controllers;

use App\Models\Veterinario;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
    public function index()
    {
        $veterinarios = Veterinario::with('especialidades')->get();
        return view('veterinarios.index', compact('veterinarios'));
    }

    public function create()
    {
        $especialidades = Especialidad::all();
        return view('veterinarios.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:veterinarios,correo',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'latitud' => 'nullable|numeric|between:-90,90',
            'longitud' => 'nullable|numeric|between:-180,180',
            'especialidades' => 'required|array|min:1', // Asegura al menos una especialidad
            'especialidades.*' => 'exists:especialidades,id', // Valida que las especialidades existan
        ], [
            'especialidades.required' => 'Debes seleccionar al menos una especialidad.',
            'especialidades.min' => 'Debes seleccionar al menos una especialidad.',
        ]);

        $veterinario = Veterinario::create($request->only('nombre', 'correo', 'telefono', 'direccion', 'latitud', 'longitud'));
        $veterinario->especialidades()->attach($request->especialidades);

        return redirect()->route('veterinarios.index')->with('exito', 'Veterinario creado con éxito.');
    }

    public function show(Veterinario $veterinario)
    {
        $veterinario->load('especialidades');
        return view('veterinarios.show', compact('veterinario'));
    }

    public function edit(Veterinario $veterinario)
    {
        $especialidades = Especialidad::all();
        return view('veterinarios.edit', compact('veterinario', 'especialidades'));
    }

    public function update(Request $request, Veterinario $veterinario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:veterinarios,correo,' . $veterinario->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'latitud' => 'nullable|numeric|between:-90,90',
            'longitud' => 'nullable|numeric|between:-180,180',
            'especialidades' => 'required|array|min:1',
            'especialidades.*' => 'exists:especialidades,id',
        ], [
            'especialidades.required' => 'Debes seleccionar al menos una especialidad.',
            'especialidades.min' => 'Debes seleccionar al menos una especialidad.',
        ]);

        $veterinario->update($request->only('nombre', 'correo', 'telefono', 'direccion', 'latitud', 'longitud'));
        $veterinario->especialidades()->sync($request->especialidades);

        return redirect()->route('veterinarios.index')->with('exito', 'Veterinario actualizado con éxito.');
    }

    public function destroy(Veterinario $veterinario)
    {
        $veterinario->delete();
        return redirect()->route('veterinarios.index')->with('exito', 'Veterinario eliminado con éxito.');
    }
}