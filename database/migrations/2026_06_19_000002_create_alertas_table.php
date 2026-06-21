<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->id('Id_alerta');
            $table->foreignId('Id_sensor')->constrained('sensores', 'Id_sensor')->onDelete('cascade');
            $table->foreignId('Id_vehiculo')->constrained('vehiculo', 'Id_vehiculo')->onDelete('cascade');
            $table->string('Tipo', 20);
            $table->string('Mensaje', 255);
            $table->boolean('Leida')->default(false);
            $table->timestamp('Fecha_alerta')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};