<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            // La ruta s'assigna quan es planifica el repartiment del dia.
            $table->foreignId('ruta_id')->nullable()->constrained('rutes')->nullOnDelete();
            $table->unsignedInteger('ordre_ruta')->nullable(); // posició de la parada dins la ruta
            $table->date('data_entrega');
            $table->string('franja_horaria')->nullable(); // "matí", "8-10h"...
            $table->string('estat')->default('pendent'); // ComandaEstat
            $table->string('origen'); // ComandaOrigen: whatsapp_text / whatsapp_audio / manual
            $table->text('notes')->nullable();
            $table->timestamps(); // created_at fa de "data_creacio"
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comandes');
    }
};
