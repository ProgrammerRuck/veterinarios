<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('veterinarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('email')->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('direccion')->nullable();
            $table->enum('especialidad', [
                'cirugía',
                'dermatología',
                'cardiología',
                'neurología',
                'oncología',
                'ortopedia',
                'endocrinología',
                'gastroenterología',
                'odontología'
            ]);
            $table->decimal('latitud', 9, 6)->nullable(); // Para el futuro mapa
            $table->decimal('longitud', 9, 6)->nullable(); // Para el futuro mapa
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veterinarios');
    }
};