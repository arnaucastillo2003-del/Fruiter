<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('linies_comanda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comanda_id')->constrained('comandes')->cascadeOnDelete();
            $table->foreignId('producte_id')->constrained('productes');
            $table->decimal('quantitat', 10, 3); // 3 decimals per admetre fraccions de kg
            $table->decimal('preu_unitari', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('linies_comanda');
    }
};
