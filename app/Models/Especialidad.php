<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';
    protected $fillable = ['nombre'];

    public function veterinarios()
    {
        return $this->belongsToMany(Veterinario::class, 'especialidad_veterinario');
    }
}