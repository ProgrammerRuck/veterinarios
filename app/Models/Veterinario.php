<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    use HasFactory;

    protected $table = 'veterinarios';
    protected $fillable = ['nombre', 'correo', 'telefono', 'direccion', 'latitud', 'longitud'];

    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'especialidad_veterinario');
    }
}