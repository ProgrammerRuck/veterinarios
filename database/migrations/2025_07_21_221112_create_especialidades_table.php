<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('especialidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        // Insertar especialidades predefinidas
        DB::table('especialidades')->insert([
            ['nombre' => 'Cirugía'],
            ['nombre' => 'Dermatología'],
            ['nombre' => 'Cardiología'],
            ['nombre' => 'Neurología'],
            ['nombre' => 'Oncología'],
            ['nombre' => 'Ortopedia'],
            ['nombre' => 'Endocrinología'],
            ['nombre' => 'Gastroenterología'],
            ['nombre' => 'Odontología'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('especialidades');
    }
};