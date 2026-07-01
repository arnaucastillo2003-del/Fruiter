<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comanda_id')->constrained('comandes');
            // La factura s'assigna quan s'agrupen albarans a final de mes.
            $table->foreignId('factura_id')->nullable()->constrained('factures')->nullOnDelete();
            $table->string('numero_albara')->unique();
            $table->date('data_emissio');
            $table->boolean('signat')->default(false);
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albarans');
    }
};
