<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('unitat'); // ProducteUnitat: kg / unitat / caixa
            $table->decimal('preu_venda', 10, 2);
            $table->decimal('preu_cost', 10, 2)->nullable();
            $table->string('categoria'); // ProducteCategoria: fruita / verdura
            $table->boolean('actiu')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productes');
    }
};
