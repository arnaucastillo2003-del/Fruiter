<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('preus_client', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('producte_id')->constrained('productes')->cascadeOnDelete();
            $table->decimal('preu_especial', 10, 2);
            $table->timestamps();

            // un client no pot tenir dos preus especials pel mateix producte
            $table->unique(['client_id', 'producte_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preus_client');
    }
};
