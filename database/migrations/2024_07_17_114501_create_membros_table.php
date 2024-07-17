<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('membros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('genero', ['Masculino', 'Feminino', 'Outro']);
            $table->boolean('batizado')->default(false);
            $table->boolean('confirmado')->default(false);
            $table->string('regiao');
            $table->string('paroquia');
            $table->enum('estado_civil', ['Solteiro', 'Casado', 'União Estável']);
            $table->string('funcao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membros');
    }
};
