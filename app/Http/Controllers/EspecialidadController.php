<?php
namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::all();
        return view('especialidades.index', compact('especialidades'));
    }

    public function create()
    {
        return view('especialidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre',
        ], [
            'nombre.required' => 'El nombre de la especialidad es obligatorio.',
            'nombre.unique' => 'Esta especialidad ya existe.',
        ]);

        Especialidad::create($request->only('nombre'));

        return redirect()->route('especialidades.index')->with('exito', 'Especialidad creada con éxito.');
    }

    public function show(Especialidad $especialidade)
    {
        return view('especialidades.show', compact('especialidade'));
    }

    public function edit(Especialidad $especialidade)
    {
        return view('especialidades.edit', compact('especialidade'));
    }

    public function update(Request $request, Especialidad $especialidade)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre,' . $especialidade->id,
        ], [
            'nombre.required' => 'El nombre de la especialidad es obligatorio.',
            'nombre.unique' => 'Esta especialidad ya existe.',
        ]);

        $especialidade->update($request->only('nombre'));

        return redirect()->route('especialidades.index')->with('exito', 'Especialidad actualizada con éxito.');
    }

    public function destroy(Especialidad $especialidade)
    {
        try {
            if ($especialidade->veterinarios()->count() > 0) {
                return redirect()->route('especialidades.index')->with('error', 'No se puede eliminar la especialidad porque está asignada a uno o más veterinarios.');
            }

            $eliminada = $especialidade->delete();

            if ($eliminada) {
                return redirect()->route('especialidades.index')->with('exito', 'Especialidad eliminada con éxito.');
            } else {
                return redirect()->route('especialidades.index')->with('error', 'No se pudo eliminar la especialidad. Intenta de nuevo.');
            }
        } catch (\Exception $e) {
            return redirect()->route('especialidades.index')->with('error', 'Error al eliminar la especialidad: ' . $e->getMessage());
        }
    }
}