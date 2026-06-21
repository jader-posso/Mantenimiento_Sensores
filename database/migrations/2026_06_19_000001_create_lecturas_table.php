<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturas', function (Blueprint $table) {
            $table->id('Id_lectura');
            $table->foreignId('Id_sensor')->constrained('sensores', 'Id_sensor')->onDelete('cascade');
            $table->foreignId('Id_vehiculo')->constrained('vehiculo', 'Id_vehiculo')->onDelete('cascade');
            $table->integer('Nivel');
            $table->string('Estado', 20);
            $table->timestamp('Fecha_lectura')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturas');
    }
};