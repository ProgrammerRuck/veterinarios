<?php
namespace App\Http\Controllers;

use App\Models\Veterinario;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('maps.index');
    }

    public function getVeterinarians()
    {
        $veterinarians = Veterinario::with('especialidades')->get()->map(function ($veterinario) {
            return [
                'id' => $veterinario->id,
                'nombre' => $veterinario->nombre,
                'latitud' => $veterinario->latitud,
                'longitud' => $veterinario->longitud,
                'especialidades' => $veterinario->especialidades->pluck('nombre')->implode(', ')
            ];
        });
        return response()->json($veterinarians);
    }

    public function getNearbyVeterinarians(Request $request)
    {
        $userLat = $request->input('lat');
        $userLng = $request->input('lng');
        $radius = 10; // Radio en kilómetros

        $veterinarians = Veterinario::select('*')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(latitud)) * cos(radians(longitud) - radians(?)) + sin(radians(?)) * sin(radians(latitud)))) AS distance',
                [$userLat, $userLng, $userLat]
            )
            ->having('distance', '<', $radius)
            ->with('especialidades')
            ->get();

        return response()->json($veterinarians->map(function ($vet) {
            return [
                'id' => $vet->id,
                'nombre' => $vet->nombre,
                'latitud' => $vet->latitud,
                'longitud' => $vet->longitud,
                'especialidades' => $vet->especialidades->pluck('nombre')->implode(', '),
                'distance' => $vet->distance
            ];
        }));
    }
}